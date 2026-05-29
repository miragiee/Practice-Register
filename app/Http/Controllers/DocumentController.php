<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentInternship;
use App\Models\Student;

class DocumentController extends Controller
{
    public function main()
    {
        $documents = Document::all();
        return view('documents', compact('documents'));
    }

    public function index(Request $request)
    {
        $documents = Document::all();

        // additionally provide student internships for admin select
        $studentInternships = StudentInternship::with(['student', 'internship', 'company'])->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($documents);
        }

        return view('documents', compact('documents', 'studentInternships'));
    }

    /**
     * Return student_internship options available to the authenticated company or university.
     */
    public function options(Request $request)
    {
        $user = Auth::user();

        $query = StudentInternship::with(['student', 'internship']);

        if ($user?->company) {
            $query->where('company_id', $user->company->id);
        } elseif ($user?->university) {
            $query->whereHas('student', function ($q) use ($user) {
                $q->where('university_id', $user->university->id);
            });
        } else {
            return response()->json([]);
        }

        $list = $query->get()->map(function ($si) {
            return [
                'id' => $si->id,
                'label' => "ID {$si->id} — {$si->student->full_name} (internship {$si->internship_id})",
            ];
        });

        return response()->json($list);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_internship_id' => 'required|integer|exists:student_internships,id',
            'file'                  => 'nullable|file|mimes:pdf,docx,doc|max:5120',
            'file_path'             => 'nullable|string|max:255',
            'type'                  => 'required|string|max:100',
        ]);

        $studentInternship = StudentInternship::findOrFail($validated['student_internship_id']);

        // Проверка прав: только компания или университет, задействованные в стажировке
        $user = Auth::user();
        $company = $user?->company;
        $university = $user?->university;

        $allowed = false;
        if ($company && $company->id === $studentInternship->company_id) {
            $allowed = true;
        }
        if ($university && $university->id === $studentInternship->student->university_id) {
            $allowed = true;
        }

        if (! $allowed) {
            abort(403, 'Доступ запрещён');
        }

        // Обработка файла (если передан)
        $filePath = $validated['file_path'] ?? null;
        $originalName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $stored = $file->store('documents', 'public');
            $filePath = $stored;
        }

        if (! $filePath) {
            return redirect()->back()->with('error', 'Файл не загружен и путь не указан');
        }

        // For versioning: compute next version for this student_internship_id + type
        $lastVersion = Document::where('student_internship_id', $validated['student_internship_id'])
            ->where('type', $validated['type'])
            ->max('version');

        $nextVersion = ($lastVersion ?? 0) + 1;

        $document = Document::create([
            'student_internship_id' => $validated['student_internship_id'],
            'file_path' => $filePath,
            'original_name' => $originalName,
            'type' => $validated['type'],
            'version' => $nextVersion,
        ]);

        // уведомления: студенту, компании и вузу
        try {
            $student = $studentInternship->student ?? null;
            $companyUser = $studentInternship->company->user ?? null;
            $universityUser = $studentInternship->student->university->user ?? null;

            if ($student && $student->email) {
                \Illuminate\Support\Facades\Notification::route('mail', $student->email)
                    ->notify(new \App\Notifications\DocumentUploaded($document));
            }

            if ($companyUser && method_exists($companyUser, 'notify')) {
                $companyUser->notify(new \App\Notifications\DocumentUploaded($document));
            }

            if ($universityUser && method_exists($universityUser, 'notify')) {
                $universityUser->notify(new \App\Notifications\DocumentUploaded($document));
            }
        } catch (\Throwable $e) {
            // ignore notification errors
        }

        return redirect()->back()->with('success', 'Документ успешно добавлен');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_internship_id' => 'nullable|integer|exists:student_internships,id',
            'file'                  => 'nullable|file|mimes:pdf,docx,doc|max:5120',
            'file_path'             => 'nullable|string|max:255',
            'type'                  => 'nullable|string|max:100',
        ]);

        $document = Document::findOrFail($id);

        $data = [];

        if (isset($validated['student_internship_id'])) {
            $data['student_internship_id'] = $validated['student_internship_id'];
        }

        if ($request->hasFile('file')) {
            // удаляем старый файл если есть
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $file = $request->file('file');
            $data['original_name'] = $file->getClientOriginalName();
            $data['file_path'] = $file->store('documents', 'public');
        } elseif (isset($validated['file_path'])) {
            $data['file_path'] = $validated['file_path'];
        }

        if (isset($validated['type'])) {
            $data['type'] = $validated['type'];
        }

        if (empty($data)) {
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        // итоговые значения для проверки дубля
        $final = [
            'student_internship_id' => $data['student_internship_id'] ?? $document->student_internship_id,
            'file_path' => $data['file_path'] ?? $document->file_path,
            'type' => $data['type'] ?? $document->type,
        ];

        $duplicate = Document::where('id', '!=', $id)
            ->where('student_internship_id', $final['student_internship_id'])
            ->where('file_path', $final['file_path'])
            ->where('type', $final['type'])
            ->exists();

        if ($duplicate) {
            return redirect()->back()->with('error', 'Такие данные уже есть в таблице');
        }

        $document->update($data);

        return redirect()->back()->with('success', 'Данные документа обновлены');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // удалить файл из диска если существует
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->back()->with('success', 'Документ удален');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);

        // basic access check: university user or company user involved, or admin
        $user = Auth::user();

        $allowed = false;
        if ($user?->company && $user->company->id === $document->studentInternship->company_id) {
            $allowed = true;
        }
        if ($user?->university && $user->university->id === $document->studentInternship->student->university_id) {
            $allowed = true;
        }
        if ($user && $user->role && $user->role->name === 'Администратор') {
            $allowed = true;
        }

        if (! $allowed) {
            abort(403, 'Доступ запрещён');
        }

        if (! Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Файл не найден');
        }

        return Storage::disk('public')->download($document->file_path, $document->original_name ?? basename($document->file_path));
    }
}

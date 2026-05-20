<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

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

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($documents);
        }

        return view('documents', compact('documents'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_internship_id' => 'required|integer',
            'file_path'             => 'required|string|max:255',
            'type'                  => 'required|string|max:100',
        ]);

        // ❗ Проверка на дубликат
        $exists = Document::where('student_internship_id', $validated['student_internship_id'])
            ->where('file_path', $validated['file_path'])
            ->where('type', $validated['type'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        Document::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Документ успешно добавлен');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_internship_id' => 'nullable|integer',
            'file_path'             => 'nullable|string|max:255',
            'type'                  => 'nullable|string|max:100',
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $document = Document::findOrFail($id);

        // итоговые значения (старые + новые)
        $final = [
            'student_internship_id' => $data['student_internship_id'] ?? $document->student_internship_id,
            'file_path'             => $data['file_path'] ?? $document->file_path,
            'type'                  => $data['type'] ?? $document->type,
        ];

        // ❗ Проверка на дубликат (исключая текущую запись)
        $duplicate = Document::where('id', '!=', $id)
            ->where('student_internship_id', $final['student_internship_id'])
            ->where('file_path', $final['file_path'])
            ->where('type', $final['type'])
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        $document->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные документа обновлены');
    }

    public function destroy($id)
    {
        Document::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Документ удален');
    }
}

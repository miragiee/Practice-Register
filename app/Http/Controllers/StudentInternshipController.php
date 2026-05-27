<?php

namespace App\Http\Controllers;

use App\Models\StudentInternship;
use App\Models\Internship;
use App\Models\Student;
use App\Models\Contract;
use Illuminate\Http\Request;

class StudentInternshipController extends Controller
{
    public function main()
    {
        $studentInternships = StudentInternship::all();
        return view('student_internships', compact('studentInternships'));
    }

    public function index(Request $request)
    {
        $studentInternships = StudentInternship::all();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($studentInternships);
        }

        return view('student_internships', compact('studentInternships'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'    => 'required|integer',
            'company_id'    => 'required|integer',
            'internship_id' => 'required|integer',
            'status'        => 'required|string|max:50',
        ]);

        // Проверяем существование студентa и стажировки
        $student = Student::findOrFail($validated['student_id']);
        $internship = Internship::findOrFail($validated['internship_id']);

        // Студент должен принадлежать тому же вузу, что и стажировка
        if ($student->university_id !== $internship->university_id) {
            return redirect()->back()->with('error', 'Студент и стажировка из разных вузов');
        }

        // Проверяем наличие активного контракта между вузом и компанией, покрывающего даты стажировки
        $hasContract = Contract::where('company_id', $validated['company_id'])
            ->where('university_id', $internship->university_id)
            ->where('status', 'active')
            ->where('start_date', '<=', $internship->start_date)
            ->where('end_date', '>=', $internship->end_date)
            ->exists();

        if (! $hasContract) {
            return redirect()->back()->with('error', 'Нет активного контракта между вузом и этой компанией, покрывающего даты стажировки');
        }

        // ❗ Проверка на дубликат
        $exists = StudentInternship::where('student_id', $validated['student_id'])
            ->where('company_id', $validated['company_id'])
            ->where('internship_id', $validated['internship_id'])
            ->where('status', $validated['status'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Такие данные уже есть в таблице');
        }

        StudentInternship::create($validated);

        return redirect()->back()->with('success', 'Стажировка студента успешно добавлена');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id'    => 'nullable|integer',
            'company_id'    => 'nullable|integer',
            'internship_id' => 'nullable|integer',
            'status'        => 'nullable|string|max:50',
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $studentInternship = StudentInternship::findOrFail($id);

        // итоговые значения (старые + новые)
        $final = [
            'student_id'    => $data['student_id'] ?? $studentInternship->student_id,
            'company_id'    => $data['company_id'] ?? $studentInternship->company_id,
            'internship_id' => $data['internship_id'] ?? $studentInternship->internship_id,
            'status'        => $data['status'] ?? $studentInternship->status,
        ];

        // ❗ Проверка на дубликат (исключая текущую запись)
        $duplicate = StudentInternship::where('id', '!=', $id)
            ->where('student_id', $final['student_id'])
            ->where('company_id', $final['company_id'])
            ->where('internship_id', $final['internship_id'])
            ->where('status', $final['status'])
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        $studentInternship->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные стажировки студента обновлены');
    }

    public function destroy($id)
    {
        StudentInternship::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Стажировка студента удалена');
    }
}

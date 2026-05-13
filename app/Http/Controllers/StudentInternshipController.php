<?php

namespace App\Http\Controllers;

use App\Models\StudentInternship;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'    => 'required|integer',
            'company_id'    => 'required|integer',
            'internship_id' => 'required|integer',
            'status'        => 'required|string|max:50',
        ]);

        StudentInternship::create($validated);

        return redirect()->back()->with('success', 'Стажировка студента успешно добавлена');
    }

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
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $studentInternship = StudentInternship::findOrFail($id);
        $studentInternship->update($data);

        return redirect()->back()->with('success', 'Данные стажировки студента обновлены');
    }

    public function destroy($id)
    {
        StudentInternship::destroy($id);
        return redirect()->back()->with('success', 'Стажировка студента удалена');
    }
}

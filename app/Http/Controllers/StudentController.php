<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function main()
    {
        $students = Student::all();
        return view("students", compact("students"));
    }

    public function index(Request $request)
    {
        $students = Student::all();

        if ($request->wantsJson()) {
            return response()->json($students);
        }

        return view("students", compact("students"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "full_name" => "required|string|max:255",
            "university_id" => "required|exists:universities,id",
            "direction_id" => "required|exists:directions,id",
            "course" => "required|integer",
            "email" => "required|string|max:255",
        ]);

        Student::create($validated);

        return redirect()->back()->with("success", "Студент успешно добавлен");
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "full_name" => "nullable|string|max:255",
            "university_id" => "nullable|exists:universities,id",
            "direction_id" => "nullable|exists:directions,id",
            "course" => "nullable|integer",
            "email" => "nullable|string|max:255",
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with("warning", "Нет данных для обновления");
        }

        $Student = Student::findOrFail($id);
        $Student->update($data);

        return redirect()->back()->with("success", "Данные обновлены");
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->back()->with("success", "Студент удалён");
    }
}

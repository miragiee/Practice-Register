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

    /*
    |--------------------------------------------------------------------------
    | СОЗДАНИЕ СТУДЕНТА
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            "full_name" => "required|string|max:255",
            "university_id" => "required|exists:universities,id",
            "direction_id" => "required|exists:directions,id",
            "course" => "required|integer",
            "email" => "required|string|max:255",
        ]);

        /*
        |--------------------------------------------------------------------------
        | Проверка дубля
        |--------------------------------------------------------------------------
        */

        $exists = Student::where("full_name", $validated["full_name"])
            ->where("university_id", $validated["university_id"])
            ->where("direction_id", $validated["direction_id"])
            ->where("course", $validated["course"])
            ->where("email", $validated["email"])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "duplicate" => "Такие данные уже есть в таблице.",
                ]);
        }

        Student::create($validated);

        return redirect()
            ->back()
            ->with("success", "Студент успешно добавлен");
    }

    /*
    |--------------------------------------------------------------------------
    | ОБНОВЛЕНИЕ СТУДЕНТА
    |--------------------------------------------------------------------------
    */

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

        $student = Student::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Проверка дубля (с исключением текущего студента)
        |--------------------------------------------------------------------------
        */

        $exists = Student::where("full_name", $data["full_name"] ?? $student->full_name)
            ->where("university_id", $data["university_id"] ?? $student->university_id)
            ->where("direction_id", $data["direction_id"] ?? $student->direction_id)
            ->where("course", $data["course"] ?? $student->course)
            ->where("email", $data["email"] ?? $student->email)
            ->where("id", "!=", $student->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "duplicate" => "Такие данные уже есть в таблице.",
                ]);
        }

        $student->update($data);

        return redirect()
            ->back()
            ->with("success", "Данные обновлены");
    }

    public function destroy($id)
    {
        Student::destroy($id);

        return redirect()
            ->back()
            ->with("success", "Студент удалён");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\University;

class StudentController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        $university = $user?->university;

        if ($university) {
            $students = Student::where('university_id', $university->id)->get();
        } else {
            $students = Student::all();
        }
        return view("students", compact("students"));
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $university = $user?->university;

        if ($university) {
            $students = Student::where('university_id', $university->id)->get();
        } else {
            $students = Student::all();
        }

        if ($request->wantsJson()) {
            return response()->json($students);
        }

        return view("students", compact("students"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "full_name" => "required|string|max:255",
            "university_id" => "nullable|exists:universities,id",
            "direction_id" => "required|exists:directions,id",
            "course" => "required|integer",
            "email" => "required|string|max:255",
            "qualities" => "nullable",
        ]);

        $validated['qualities'] = $this->normalizeQualities($request->input('qualities'));

        $user = Auth::user();
        $university = $user?->university;

        // Если пользователь — вуз, привязываем студента к его вузу
        if ($university) {
            $validated['university_id'] = $university->id;
        }

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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "full_name" => "nullable|string|max:255",
            "university_id" => "nullable|exists:universities,id",
            "direction_id" => "nullable|exists:directions,id",
            "course" => "nullable|integer",
            "email" => "nullable|string|max:255",
            "qualities" => "nullable",
        ]);

        if ($request->has('qualities')) {
            $validated['qualities'] = $this->normalizeQualities($request->input('qualities'));
        }

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            if ($request->wantsJson()) {
                return response()->json(["message" => "Нет данных для обновления"], 400);
            }
            return redirect()
                ->back()
                ->with("warning", "Нет данных для обновления");
        }

        $student = Student::findOrFail($id);

        $user = Auth::user();
        $university = $user?->university;

        if ($university && $student->university_id !== $university->id) {
            if ($request->wantsJson()) {
                return response()->json(["message" => "Доступ запрещён"], 403);
            }
            return redirect()->back()->with('error', 'Доступ запрещён');
        }

        $exists = Student::where("full_name", $data["full_name"] ?? $student->full_name)
            ->where("university_id", $data["university_id"] ?? $student->university_id)
            ->where("direction_id", $data["direction_id"] ?? $student->direction_id)
            ->where("course", $data["course"] ?? $student->course)
            ->where("email", $data["email"] ?? $student->email)
            ->where("id", "!=", $student->id)
            ->exists();

        if ($exists) {
            if ($request->wantsJson()) {
                return response()->json(["message" => "Такие данные уже есть в таблице"], 400);
            }
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "duplicate" => "Такие данные уже есть в таблице.",
                ]);
        }

        $student->update($data);

        if ($request->wantsJson()) {
            return response()->json(["message" => "Данные обновлены", "student" => $student]);
        }

        return redirect()
            ->back()
            ->with("success", "Данные обновлены");
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $user = Auth::user();
        $university = $user?->university;

        if ($university && $student->university_id !== $university->id) {
            return redirect()->back()->with('error', 'Доступ запрещён');
        }

        Student::destroy($id);
        return redirect()
            ->back()
            ->with("success", "Студент удалён");
    }

        public function reservations()
    {
        $user = Auth::user();
        if (!$user) {
            return view('partials.reservations-list', ['reservations' => collect()]);
        }

        $student = Student::where('email', $user->email)->first();
        if (!$student) {
            return view('partials.reservations-list', ['reservations' => collect()]);
        }

        $reservations = $student->reservations()
            ->with(['internship', 'company'])
            ->latest()
            ->get();

        return view('partials.reservations-list', compact('reservations'));
    }

    public function cancelReservation(Reservation $reservation)
    {
        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        if (!$student || $reservation->student_id !== $student->id) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }

        $reservation->delete();
        return response()->json(['success' => true]);
    }

    protected function normalizeQualities($qualities): array
    {
        if (is_array($qualities)) {
            return array_values(array_filter(array_map('trim', $qualities), fn($item) => $item !== ''));
        }

        if (is_string($qualities)) {
            $decoded = json_decode($qualities, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded), fn($item) => $item !== ''));
            }

            return array_values(array_filter(array_map('trim', preg_split('/,/', $qualities) ?: []), fn($item) => $item !== ''));
        }

        return [];
    }
}

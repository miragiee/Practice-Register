<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Internship;
use App\Models\Contract;
use App\Models\StudentInternship;

class ReservationController extends Controller
{
    public function main()
    {
        $reservations = Reservation::all();
        return view('reservations', compact('reservations'));
    }

    public function index(Request $request)
    {
        $reservations = Reservation::all();

        if ($request->wantsJson()) {
            return response()->json($reservations);
        }

        return view('reservations', compact('reservations'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'internship_id' => 'required|integer|exists:internships,id',
            'status' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $company = $user?->company;

        if (! $company) {
            abort(403, 'Только компания может бронировать студентов');
        }

        $student = Student::findOrFail($validated['student_id']);
        $internship = Internship::findOrFail($validated['internship_id']);

        // Студент и стажировка должны относиться к одному вузу
        if ($student->university_id !== $internship->university_id) {
            return redirect()->back()->with('error', 'Студент и стажировка из разных вузов');
        }

        // Проверка: студент уже передан на стажировку
        $alreadyAssigned = StudentInternship::where('student_id', $student->id)
            ->where('status', 'assigned')
            ->exists();

        if ($alreadyAssigned) {
            return redirect()->back()->with('error', 'Студент уже передан на стажировку');
        }

        // Проверка на активный контракт между вузом и компанией, покрывающий даты стажировки
        $hasContract = Contract::where('company_id', $company->id)
            ->where('university_id', $internship->university_id)
            ->where('status', 'active')
            ->where('start_date', '<=', $internship->start_date)
            ->where('end_date', '>=', $internship->end_date)
            ->exists();

        if (! $hasContract) {
            return redirect()->back()->with('error', 'Нет активного контракта между вузом и вашей компанией');
        }

        // ❗ Проверка на дубликат (по компании)
        $exists = Reservation::where('company_id', $company->id)
            ->where('student_id', $validated['student_id'])
            ->where('internship_id', $validated['internship_id'])
            ->where('status', $validated['status'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Такие данные уже есть в таблице');
        }

        $reservation = Reservation::create([
            'company_id' => $company->id,
            'student_id' => $validated['student_id'],
            'internship_id' => $validated['internship_id'],
            'status' => $validated['status'],
        ]);

        // уведомления вузу и компании (попытка, ошибки игнорируем)
        try {
            $universityUser = $reservation->internship->university->user ?? null;
            $companyUser = $company->user ?? null;

            if ($universityUser && method_exists($universityUser, 'notify')) {
                $universityUser->notify(new \App\Notifications\ReservationCreated($reservation));
            }

            if ($companyUser && method_exists($companyUser, 'notify')) {
                $companyUser->notify(new \App\Notifications\ReservationCreated($reservation));
            }
        } catch (\Throwable $e) {
            // ignore
        }

        return redirect()->back()->with('success', 'Резервация успешно добавлена');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_id' => 'nullable|integer',
            'student_id' => 'nullable|integer',
            'internship_id' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $reservation = Reservation::findOrFail($id);

        // итоговые значения (старые + новые)
        $final = [
            'company_id'    => $data['company_id'] ?? $reservation->company_id,
            'student_id'    => $data['student_id'] ?? $reservation->student_id,
            'internship_id' => $data['internship_id'] ?? $reservation->internship_id,
            'status'        => $data['status'] ?? $reservation->status,
        ];

        // ❗ Проверка на дубликат (исключая текущую запись)
        $duplicate = Reservation::where('id', '!=', $id)
            ->where('company_id', $final['company_id'])
            ->where('student_id', $final['student_id'])
            ->where('internship_id', $final['internship_id'])
            ->where('status', $final['status'])
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        $reservation->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные обновлены');
    }

    public function destroy($id)
    {
        Reservation::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Резервация удалена');
    }
}

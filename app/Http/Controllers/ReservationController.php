<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

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
            'company_id' => 'required|integer',
            'student_id' => 'required|integer',
            'internship_id' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        // ❗ Проверка на дубликат
        $exists = Reservation::where('company_id', $validated['company_id'])
            ->where('student_id', $validated['student_id'])
            ->where('internship_id', $validated['internship_id'])
            ->where('status', $validated['status'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        Reservation::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Резервация успешно добавлена');
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

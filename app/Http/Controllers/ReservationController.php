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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|integer',
            'student_id' => 'required|integer',
            'internship_id' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        Reservation::create($validated);

        return redirect()->back()->with('success', 'Резервация успешно добавлена');
    }

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
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $reservation = Reservation::findOrFail($id);
        $reservation->update($data);

        return redirect()->back()->with('success', 'Данные обновлены');
    }

    public function destroy($id)
    {
        Reservation::destroy($id);

        return redirect()->back()->with('success', 'Резервация удалена');
    }
}

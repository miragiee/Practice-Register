<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function main()
    {
        $internships = Internship::all();

        return view('internships', compact('internships'));
    }

    public function index(Request $request)
    {
        $internships = Internship::all();

        if ($request->wantsJson()) {
            return response()->json($internships);
        }

        return view('internships', compact('internships'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
        ]);

        // ❗ Проверка на дубликат
        $exists = Internship::where('university_id', $validated['university_id'])
            ->where('start_date', $validated['start_date'])
            ->where('end_date', $validated['end_date'])
            ->where('description', $validated['description'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        Internship::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Стажировка успешно добавлена');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'university_id' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $internship = Internship::findOrFail($id);

        // итоговые значения (старые + новые)
        $final = [
            'university_id' => $data['university_id'] ?? $internship->university_id,
            'start_date'    => $data['start_date'] ?? $internship->start_date,
            'end_date'      => $data['end_date'] ?? $internship->end_date,
            'description'   => $data['description'] ?? $internship->description,
        ];

        // ❗ Проверка на дубликат (кроме текущей записи)
        $duplicate = Internship::where('id', '!=', $id)
            ->where('university_id', $final['university_id'])
            ->where('start_date', $final['start_date'])
            ->where('end_date', $final['end_date'])
            ->where('description', $final['description'])
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        $internship->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные обновлены');
    }

    public function destroy($id)
    {
        Internship::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Стажировка удалена');
    }
}

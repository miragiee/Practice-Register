<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use App\Models\University;

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

    public function create()
{
    $internships = Internship::latest()->get();
    $universities = University::all();

    return view('create_internship', compact('internships', 'universities'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|integer',
            'direction_id' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'capacity' => 'nullable|integer|min:0',
            'qualities' => 'nullable',
            'description' => 'required|string',
        ]);

        $validated['qualities'] = $this->normalizeQualities($request->input('qualities'));

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
            ->with('success', 'Практика успешно добавлена');
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
            'direction_id' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'capacity' => 'nullable|integer|min:0',
            'qualities' => 'nullable',
            'description' => 'nullable|string',
        ]);

        if ($request->has('qualities')) {
            $validated['qualities'] = $this->normalizeQualities($request->input('qualities'));
        }

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

<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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


    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
        ]);

        Internship::create($validated);

        return redirect()->back()->with('success', 'Стажировка успешно добавлена');
    }


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
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $internship = Internship::findOrFail($id);
        $internship->update($data);

        return redirect()->back()->with('success', 'Данные обновлены');
    }


    public function destroy($id)
    {
        Internship::destroy($id);

        return redirect()->back()->with('success', 'Стажировка удалена');
    }
}

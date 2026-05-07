<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::all();
        if (request()->wantsJson()) {
            return response()->json($universities);
        }
        return view('universities', compact('universities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'city' => 'required',
            'contact_info' => 'required',
        ]);

        University::create($validated);
        return redirect()->back()->with('success', 'Университет добавлен');
    }

    public function update(Request $request, University $university)
    {
        $data = array_filter($request->only(['name', 'city', 'contact_info']), function($v) {
            return !is_null($v) && $v !== '';
        });

        $university->update($data);
        return redirect()->back()->with('success', 'Данные обновлены');
    }

    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->back()->with('success', 'Университет удалён');
    }
}

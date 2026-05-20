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
        /*
        |--------------------------------------------------------------------------
        | Валидация
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'contact_info' => 'required|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Проверка на дубликат
        |--------------------------------------------------------------------------
        */

        $exists = University::where('name', $validated['name'])
            ->where('city', $validated['city'])
            ->where('contact_info', $validated['contact_info'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'duplicate' => 'Такие данные уже есть в таблице.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Создание записи
        |--------------------------------------------------------------------------
        */

        University::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Университет добавлен');
    }

    public function update(Request $request, University $university)
    {
        $data = array_filter(
            $request->only(['name', 'city', 'contact_info']),
            function ($v) {
                return !is_null($v) && $v !== '';
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Проверка на дубликат при обновлении
        |--------------------------------------------------------------------------
        */

        $exists = University::where('name', $data['name'] ?? $university->name)
            ->where('city', $data['city'] ?? $university->city)
            ->where('contact_info', $data['contact_info'] ?? $university->contact_info)
            ->where('id', '!=', $university->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'duplicate' => 'Такие данные уже есть в таблице.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Обновление записи
        |--------------------------------------------------------------------------
        */

        $university->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные обновлены');
    }

    public function destroy(University $university)
    {
        $university->delete();

        return redirect()
            ->back()
            ->with('success', 'Университет удалён');
    }
}

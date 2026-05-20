<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;

class DirectionController extends Controller
{
    public function main(){
        $directions = Direction::all();
        return view('directions', compact('directions'));
    }

    public function index(Request $request){
        $directions = Direction::all();

        if($request->wantsJson()){
            return response()->json($directions);
        }

        return view('directions', compact('directions'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (создание)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // ❗ Проверка на дубликат
        $exists = Direction::where('name', $validated['name'])
            ->where('description', $validated['description'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        Direction::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Направление успешно добавлено');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (обновление)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $data = array_filter($validated, function ($value){
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $direction = Direction::findOrFail($id);

        // ❗ Проверка на дубликат при обновлении
        $duplicate = Direction::where('id', '!=', $id)
            ->where('name', $data['name'] ?? $direction->name)
            ->where('description', $data['description'] ?? $direction->description)
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        $direction->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные обновлены');
    }

    public function destroy($id){
        Direction::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Направление удалёно');
    }
}

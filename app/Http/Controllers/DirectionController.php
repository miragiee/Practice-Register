<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;
use illuminate\http\JsonResponse;

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

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Direction::create($validated);

        return redirect()->back()->with('success', 'Направление успешно добавлено');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $data = array_filter($validated, function ($value){
            return $value !== null && $value !== "";
        });

        if(empty($data)) {
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $Direction = Direction::findOrFail($id);
        $Direction->update($data);

        return redirect()->back()->with('success', 'Данные обновлены');
    }

    public function destroy($id){
        Direction::destroy($id);
        return redirect()->back()->with('success', 'Направление удалёно');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::all();

        return response()->json($companies);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_info' => 'required|string',
        ]);

        Company::create($validated);

        return redirect()->back()->with('success', 'Компания успешно добавлена');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_info' => 'required|string',
        ]);

        $company = Company::findOrFail($id);
        $company -> update($validated);

        return redirect()->back()->with('success', 'Данные обновлены');
    }

    public function destroy($id){
        Company::destroy($id);
        return redirect()->back()->with('success', 'Компания удалена');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    
    public function main(){
        $companies = Company::all();
        return view('companies', compact('companies'));
    }
    
    public function index(Request $request){
        $companies = Company::all();

        if ($request->wantsJson()) {
            return response()->json($companies);
        }
        return view('companies', compact('companies'));
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
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'contact_info' => 'sometimes|string',
        ]);

        $data = array_filter($validated, function ($value){
            return $value !== null && $value !== "";
        });

        if(empty($data)) {
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $company = Company::findOrFail($id);
        $company->update($data);

        return redirect()->back()->with('success', 'Данные обновлены');
    }

    public function destroy($id){
        Company::destroy($id);
        return redirect()->back()->with('success', 'Компания удалена');
    }
}

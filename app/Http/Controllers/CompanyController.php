<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $companies = Company::all();

        if (request()->wantsJson()) {
            return response()->json($companies);
        }

        return view("companies", compact("companies"));
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER COMPANY
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            "company_name" => ["required", "string", "max:255"],

            "email" => ["required", "email", "unique:users,email"],

            "password" => ["required", "min:6"],

            "inn" => ["nullable", "string", "max:20"],

            "website" => ["nullable", "string", "max:255"],

            "description" => ["nullable", "string"],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE USER
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            "name" => $validated["company_name"],

            "email" => $validated["email"],

            "password" => Hash::make($validated["password"]),

            "role_id" => 4,
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE COMPANY
        |--------------------------------------------------------------------------
        */

        Company::create([
            "user_id" => $user->id,

            "name" => $validated["company_name"],

            "description" => $validated["description"] ?? null,

            "contact_info" => $validated["email"],

            "inn" => $validated["inn"] ?? null,

            "website" => $validated["website"] ?? null,
        ]);

        return redirect()->route("register-step-3");
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",

            "contact_info" => "required|string",
        ]);

        Company::create($validated);

        return redirect()->back()->with("success", "Компания добавлена");
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Company $company)
    {
        $data = array_filter(
            $request->only([
                "name",

                "description",

                "contact_info",

                "inn",

                "website",
            ]),

            function ($v) {
                return !is_null($v) && $v !== "";
            },
        );

        $company->update($data);

        return redirect()->back()->with("success", "Компания обновлена");
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->back()->with("success", "Компания удалена");
    }
}

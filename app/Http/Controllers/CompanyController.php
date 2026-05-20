<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CompanyController extends Controller
{
    public function main()
    {
        $companies = Company::all();

        return view("companies", compact("companies"));
    }

    public function index(Request $request)
    {
        $companies = Company::all();

        if ($request->wantsJson()) {
            return response()->json($companies);
        }

        return view("companies", compact("companies"));
    }

    /*
    |--------------------------------------------------------------------------
    | Добавление компании
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "contact_info" => "required|string",
        ]);

        /*
        |--------------------------------------------------------------------------
        | Проверка на дубликат
        |--------------------------------------------------------------------------
        */

        $exists = Company::where("name", $validated["name"])
            ->where("description", $validated["description"])
            ->where("contact_info", $validated["contact_info"])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "duplicate" => "Такие данные уже есть в таблице.",
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Создание компании
        |--------------------------------------------------------------------------
        */

        Company::create($validated);

        return redirect()
            ->back()
            ->with("success", "Компания успешно добавлена");
    }

    /*
    |--------------------------------------------------------------------------
    | Обновление компании
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "nullable|string|max:255",
            "description" => "nullable|string",
            "contact_info" => "nullable|string",
        ]);

        /*
        |--------------------------------------------------------------------------
        | Удаляем пустые поля
        |--------------------------------------------------------------------------
        */

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with("warning", "Нет данных для обновления");
        }

        /*
        |--------------------------------------------------------------------------
        | Получаем компанию
        |--------------------------------------------------------------------------
        */

        $company = Company::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Проверка на дубликат
        |--------------------------------------------------------------------------
        */

        $exists = Company::where(
                "name",
                $data["name"] ?? $company->name
            )
            ->where(
                "description",
                $data["description"] ?? $company->description
            )
            ->where(
                "contact_info",
                $data["contact_info"] ?? $company->contact_info
            )
            ->where("id", "!=", $company->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "duplicate" => "Такие данные уже есть в таблице.",
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Обновление данных
        |--------------------------------------------------------------------------
        */

        $company->update($data);

        return redirect()
            ->back()
            ->with("success", "Данные обновлены");
    }

    /*
    |--------------------------------------------------------------------------
    | Удаление компании
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        Company::destroy($id);

        return redirect()
            ->back()
            ->with("success", "Компания удалена");
    }

    /*
    |--------------------------------------------------------------------------
    | Регистрация компании
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:companies,name",
            "description" => "required|string|max:255",
            "contact_info" => "required|email|unique:companies,contact_info",
            "password" => "required|string|min:6",
            "full_name" => "required|string|max:255",
            "inn" => "required|string|unique:companies,inn",
            "website" => "nullable|string|max:255",
        ]);

        /*
        |--------------------------------------------------------------------------
        | Проверка на полный дубликат
        |--------------------------------------------------------------------------
        */

        $exists = Company::where("name", $validated["name"])
            ->where("description", $validated["description"])
            ->where("contact_info", $validated["contact_info"])
            ->where("inn", $validated["inn"])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "duplicate" => "Такие данные уже есть в таблице.",
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Создание компании
        |--------------------------------------------------------------------------
        */

        $company = Company::create([
            "name" => $validated["name"],
            "description" => $validated["description"],
            "contact_info" => $validated["contact_info"],
            "inn" => $validated["inn"],
            "website" => $validated["website"],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Создание пользователя
        |--------------------------------------------------------------------------
        */

        User::create([
            "name" => $validated["full_name"],
            "email" => $validated["contact_info"],
            "password" => Hash::make($validated["password"]),
            "role_id" => 4,
        ]);

        return redirect()
            ->route("register-step-3")
            ->with("success", "Компания успешно зарегистрирована");
    }
}

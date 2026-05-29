<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UniversityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Список университетов
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $universities = University::with("user")->get();

        if (request()->wantsJson()) {
            return response()->json($universities);
        }

        return view("universities", compact("universities"));
    }

    /*
    |--------------------------------------------------------------------------
    | Страница регистрации
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view("register-step-2-university");
    }

    /*
    |--------------------------------------------------------------------------
    | Регистрация университета
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Валидация
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            "name" => "required|string|max:255",

            "inn" => "required|string|min:10|max:12|unique:universities,inn",

            "email" => "required|email|unique:users,email",

            "password" => [
                "required",
                "string",
                "min:8",
                "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).+$/",
            ],

            "contact_person" => "required|string|max:255",

            "position" => "required|string|max:255",

            "phone" => "required|string|max:255",
        ], [
            "password.min" => "Пароль должен быть не менее 8 символов.",
            "password.regex" => "Пароль должен содержать минимум одну заглавную букву, одну строчную букву, одну цифру и один специальный символ.",
        ]);

        DB::beginTransaction();

        try {
            /*
            |--------------------------------------------------------------------------
            | Создание пользователя
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                "name" => $validated["name"],

                "email" => $validated["email"],

                "password" => Hash::make($validated["password"]),

                "role_id" => 2,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Создание университета
            |--------------------------------------------------------------------------
            */

            University::create([
                "user_id" => $user->id,

                "name" => $validated["name"],

                "inn" => $validated["inn"],

                "contact_person" => $validated["contact_person"],

                "position" => $validated["position"],

                "phone" => $validated["phone"],
            ]);

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | Переход на step 3
            |--------------------------------------------------------------------------
            */

            return redirect()->route("register-step-3");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    "error" => "Ошибка при регистрации университета",
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Обновление университета
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            "name" => "nullable|string|max:255",

            "inn" =>
                "nullable|string|min:10|max:12|unique:universities,inn," .
                $university->id,

            "contact_person" => "nullable|string|max:255",

            "position" => "nullable|string|max:255",

            "phone" => "nullable|string|max:255",
        ]);

        $data = array_filter($validated, function ($value) {
            return !is_null($value) && $value !== "";
        });

        $university->update($data);

        /*
        |--------------------------------------------------------------------------
        | Обновляем user.name
        |--------------------------------------------------------------------------
        */

        if (isset($data["name"])) {
            $university->user->update([
                "name" => $data["name"],
            ]);
        }

        return redirect()->back()->with("success", "Данные обновлены");
    }

    /*
    |--------------------------------------------------------------------------
    | Удаление университета
    |--------------------------------------------------------------------------
    */

    public function destroy(University $university)
    {
        DB::beginTransaction();

        try {
            /*
            |--------------------------------------------------------------------------
            | Удаляем пользователя
            |--------------------------------------------------------------------------
            */

            if ($university->user) {
                $university->user->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Удаляем университет
            |--------------------------------------------------------------------------
            */

            $university->delete();

            DB::commit();

            return redirect()->back()->with("success", "Университет удалён");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors([
                    "error" => "Ошибка при удалении",
                ]);
        }
    }
}

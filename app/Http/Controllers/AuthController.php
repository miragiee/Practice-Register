<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view("auth");
    }

    public function studentProfile()
    {
        $user = Auth::user();

        $student = Student::with(["university", "direction"])
            ->where("email", $user->email)
            ->first();

        if (!$student) {
            abort(404, "Студент не найден");
        }

        return view("student-profile", compact("student", "user"));
    }

    public function studentLogin(Request $request)
    {
        $request->validate(
            [
                "email" => ["required", "email", "max:255"],
                "password" => ["required", "string", "min:6"],
            ],
            [
                "email.required" => "Email обязателен для заполнения.",
                "email.email" => "Введите корректный email адрес.",
                "email.max" => "Email слишком длинный.",
                "password.required" => "Пароль обязателен для заполнения.",
                "password.min" =>
                    "Пароль должен содержать не менее 6 символов.",
            ],
        );

        $credentials = $request->only("email", "password");
        $remember = $request->boolean("remember");

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only("email"))
                ->withErrors(["email" => "Неверный email или пароль."]);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->role || $user->role->name !== "Студент") {
            Auth::logout();
            $request->session()->invalidate();

            return back()
                ->withInput($request->only("email"))
                ->withErrors([
                    "email" => "Этот аккаунт не является студенческим.",
                ]);
        }

        $request->session()->regenerate();

        return redirect()->route("student-profile");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("auth");
    }
}

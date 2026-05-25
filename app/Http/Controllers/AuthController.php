<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Student;
use App\Models\Company;
use App\Models\University;
use App\Models\Direction;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view("auth");
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT LOGIN
    |--------------------------------------------------------------------------
    */

    public function studentLogin(Request $request)
    {
        return $this->loginByRole(
            $request,
            3,
            "student-profile",
            "Это не аккаунт студента",
        );
    }

    /*
    |--------------------------------------------------------------------------
    | COMPANY LOGIN
    |--------------------------------------------------------------------------
    */

    public function companyLogin(Request $request)
    {
        return $this->loginByRole(
            $request,
            4,
            "company-profile",
            "Это не аккаунт компании",
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY LOGIN
    |--------------------------------------------------------------------------
    */

    public function universityLogin(Request $request)
    {
        return $this->loginByRole(
            $request,
            2,
            "university-profile",
            "Это не аккаунт университета",
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UNIVERSAL LOGIN METHOD
    |--------------------------------------------------------------------------
    */

    private function loginByRole(
        Request $request,
        int $roleId,
        string $route,
        string $roleError,
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([
            "email" => ["required", "email"],

            "password" => ["required", "string", "min:6"],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREDENTIALS
        |--------------------------------------------------------------------------
        */

        $credentials = $request->only("email", "password");

        /*
        |--------------------------------------------------------------------------
        | LOGIN ATTEMPT
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials)) {
            return back()
                ->withInput($request->only("email"))
                ->withErrors([
                    "email" => "Неверный email или пароль.",
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | ROLE CHECK
        |--------------------------------------------------------------------------
        */

        if ($user->role_id != $roleId) {
            Auth::logout();

            return back()->withErrors([
                "email" => $roleError,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()->route($route);
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT PROFILE
    |--------------------------------------------------------------------------
    */

    public function studentProfile()
    {
        $user = Auth::user();

        $student = Student::with(["university", "direction"])
            ->where("email", $user->email)
            ->first();

        if (!$student) {
            abort(404, "Студент не найден");
        }

        $universities = University::all();
        $directions = Direction::all();

        $studentInternships = $student->studentInternships()
            ->with('documents')
            ->get();

        return view("student-profile", compact(
            "student",
            "user",
            "universities",
            "directions",
            "studentInternships"
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | COMPANY PROFILE
    |--------------------------------------------------------------------------
    */

    public function companyProfile()
    {
        $user = Auth::user();

        $company = Company::where("user_id", $user->id)->first();

        if (!$company) {
            abort(404, "Компания не найдена");
        }

        return view("company-profile", compact("company", "user"));
    }
    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY PROFILE
    |--------------------------------------------------------------------------
    */

    public function universityProfile()
    {
        $user = Auth::user();

        $university = University::where("user_id", $user->id)->first();

        if (!$university) {
            abort(404, "Университет не найден");
        }

        return view("university-profile", compact("university", "user"));
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("auth");
    }
}

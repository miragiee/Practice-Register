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
    // ID ролей (лучше вынести в конфиг или модель)
    const ROLE_ADMIN      = 1;
    const ROLE_UNIVERSITY = 2;
    const ROLE_STUDENT    = 3;
    const ROLE_COMPANY    = 4;

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
        return $this->loginByRole($request, self::ROLE_STUDENT);
    }

    /*
    |--------------------------------------------------------------------------
    | COMPANY LOGIN
    |--------------------------------------------------------------------------
    */

    public function companyLogin(Request $request)
    {
        return $this->loginByRole($request, self::ROLE_COMPANY);
    }

    /*
    |--------------------------------------------------------------------------
    | UNIVERSITY LOGIN
    |--------------------------------------------------------------------------
    */

    public function universityLogin(Request $request)
    {
        return $this->loginByRole($request, self::ROLE_UNIVERSITY);
    }

    /*
    |--------------------------------------------------------------------------
    | UNIVERSAL LOGIN METHOD
    |--------------------------------------------------------------------------
    */

    private function loginByRole(Request $request, int $expectedRoleId)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([
            "email"    => ["required", "email"],
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
        | ADMIN CAN LOGIN VIA ANY TAB
        |--------------------------------------------------------------------------
        */

        if ($user->role_id === self::ROLE_ADMIN) {
            return redirect()->route('admin');
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE CHECK (for non‑admin users)
        |--------------------------------------------------------------------------
        */

        if ($user->role_id !== $expectedRoleId) {
            Auth::logout();
            return back()->withErrors([
                "email" => "Это не аккаунт выбранной роли.",
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT ACCORDING TO ROLE
        |--------------------------------------------------------------------------
        */

        switch ($user->role_id) {
            case self::ROLE_STUDENT:
                return redirect()->route('student-profile');
            case self::ROLE_COMPANY:
                return redirect()->route('company-profile');
            case self::ROLE_UNIVERSITY:
                return redirect()->route('university-profile');
            default:
                Auth::logout();
                return redirect()->route('auth')->withErrors([
                    'email' => 'Неизвестная роль пользователя.'
                ]);
        }
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

    public function updateUniversityProfile(Request $request)
    {
        $user = Auth::user();
        $university = University::where("user_id", $user->id)->first();

        if (!$university) {
            return response()->json(["message" => "Университет не найден"], 404);
        }

        $validated = $request->validate([
            "name" => "nullable|string|max:255",
            "inn" => "nullable|string|min:10|max:12|unique:universities,inn," . $university->id,
            "contact_person" => "nullable|string|max:255",
            "position" => "nullable|string|max:255",
            "phone" => "nullable|string|max:255",
        ]);

        $data = array_filter($validated, function ($value) {
            return !is_null($value) && $value !== "";
        });

        $university->update($data);

        if (isset($data["name"])) {
            $university->user->update([
                "name" => $data["name"],
            ]);
        }

        return response()->json(["message" => "Данные обновлены"], 200);
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
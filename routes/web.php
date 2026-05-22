<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentInternshipController;
use App\Http\Controllers\UniversityController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware("nocache")->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Главная
    |--------------------------------------------------------------------------
    */

    Route::view("/", "main")->name("main.page");

    /*
    |--------------------------------------------------------------------------
    | Регистрация
    |--------------------------------------------------------------------------
    */

    Route::prefix("register")->group(function () {
        Route::view("/", "register")->name("register");

        /*
        |--------------------------------------------------------------------------
        | Company
        |--------------------------------------------------------------------------
        */

        Route::view("/step-2-company", "register-step-2-company")->name(
            "register-step-2-company",
        );

        Route::post("/company", [CompanyController::class, "register"])->name(
            "company.register",
        );

        /*
        |--------------------------------------------------------------------------
        | University
        |--------------------------------------------------------------------------
        */

        Route::view("/step-2-university", "register-step-2-university")->name(
            "register-step-2-university",
        );

        Route::post("/step-2-university", [
            UniversityController::class,
            "store",
        ])->name("university.store");

        /*
        |--------------------------------------------------------------------------
        | Step 3
        |--------------------------------------------------------------------------
        */

        Route::view("/step-3", "register-step-3")->name("register-step-3");
    });

    /*
    |--------------------------------------------------------------------------
    | Авторизация
    |--------------------------------------------------------------------------
    */

    Route::get("/auth", [AuthController::class, "showLogin"])->name("auth");

    /*
    |--------------------------------------------------------------------------
    | Students Search
    |--------------------------------------------------------------------------
    */

    Route::view("/students-in-search", "students-in-search")->name(
        "students-in-search",
    );
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix("auth")->group(function () {
    Route::post("/student", [AuthController::class, "studentLogin"])->name(
        "auth.student",
    );

    Route::post("/company", [AuthController::class, "companyLogin"])->name(
        "auth.company",
    );

    Route::post("/university", [
        AuthController::class,
        "universityLogin",
    ])->name("auth.university");
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post("/logout", [AuthController::class, "logout"])->name("logout");

/*
|--------------------------------------------------------------------------
| PROFILES
|--------------------------------------------------------------------------
*/

Route::middleware(["auth", "nocache"])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Student Profile
    |--------------------------------------------------------------------------
    */

    Route::get("/profile/student", [
        AuthController::class,
        "studentProfile",
    ])->name("student-profile");

    /*
    |--------------------------------------------------------------------------
    | Company Profile
    |--------------------------------------------------------------------------
    */

    Route::get("/profile/company", [
        AuthController::class,
        "companyProfile",
    ])->name("company-profile");

    Route::get("/profile/university", [
        AuthController::class,
        "universityProfile",
    ])->name("university-profile");

    /*
    |--------------------------------------------------------------------------
    | University Profile
    |--------------------------------------------------------------------------
    */

    Route::get("/profile/university", [
        AuthController::class,
        "universityProfile",
    ])->name("university-profile");
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware([
    "auth",
    "nocache",
    \App\Http\Middleware\AdminMiddleware::class,
])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get("/admin", [AdminController::class, "index"])->name("admin");

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    Route::resources([
        "companies" => CompanyController::class,

        "universities" => UniversityController::class,

        "students" => StudentController::class,

        "directions" => DirectionController::class,

        "internships" => InternshipController::class,

        "contracts" => ContractController::class,

        "reservations" => ReservationController::class,

        "documents" => DocumentController::class,

        "student-internships" => StudentInternshipController::class,

        "profile-university" => UniversityController::class,
    ]);
});

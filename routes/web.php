<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudentInternshipController;
use App\Http\Controllers\AuthController;

Route::get("/", function () {
    return view("main");
})->name("main.page");

Route::get("/register", function () {
    return view("register");
})->name("register");

Route::get("/register/step-2-company", function () {
    return view("register-step-2-company");
})->name("register-step-2-company");

Route::get("/register/step-2-university", function () {
    return view("register-step-2-university");
})->name("register-step-2-university");

Route::get("/register/step-3", function () {
    return view("register-step-3");
})->name("register-step-3");

Route::get("/profile/student", [AuthController::class, "studentProfile"])
    ->middleware("auth")
    ->name("student-profile");

Route::get("/profile/company", function () {
    return view("company-profile");
})->name("company-profile");

Route::get("/auth", [AuthController::class, "showLogin"])->name("auth");
Route::post("/auth/student", [AuthController::class, "studentLogin"])->name(
    "auth.student",
);
Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::get("/students-in-search", function () {
    return view("students-in-search");
})->name("students-in-search");

Route::resource("companies", CompanyController::class);
Route::resource("universities", UniversityController::class);
Route::resource("students", StudentController::class);
Route::resource("directions", DirectionController::class);
Route::resource("internships", InternshipController::class);
Route::resource("contracts", ContractController::class);
Route::resource("reservations", ReservationController::class);
Route::resource("documents", DocumentController::class);
Route::resource("student-internships", StudentInternshipController::class);

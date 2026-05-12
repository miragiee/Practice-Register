<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('main');
});

Route::resource('companies', CompanyController::class);
Route::resource('universities', UniversityController::class);
Route::resource('students', StudentController::class);
Route::resource('directions', DirectionController::class);
Route::resource('internships', InternshipController::class);
Route::resource('reservations', ReservationController::class);

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

Route::get('/', function () {
    return view('main');
})->name('main.page');

Route::resource('companies', CompanyController::class);
Route::resource('universities', UniversityController::class);
Route::resource('students', StudentController::class);
Route::resource('directions', DirectionController::class);
Route::resource('internships', InternshipController::class);
Route::resource('contracts', ContractController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('documents', DocumentController::class);
Route::resource('student-internships', StudentInternshipController::class);

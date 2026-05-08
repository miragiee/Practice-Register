<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;

Route::get('/', function () {
    return view('main');
});

Route::resource('companies', CompanyController::class);
Route::resource('universities', UniversityController::class);
Route::resource('students', StudentController::class);

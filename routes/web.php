<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('main');
});

Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);


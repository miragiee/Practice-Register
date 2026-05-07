<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('main');
});

Route::get('/companies', [CompanyController::class, 'index']);

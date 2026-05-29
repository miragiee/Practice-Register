<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyRequestController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentInternshipController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\ContractRequestController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware("nocache")->group(function () {
    Route::view("/", "main")->name("main.page");
    Route::view("/help", "help")->name("help");

    Route::prefix("register")->group(function () {
        Route::view("/", "register")->name("register");

        Route::view("/step-2-company", "register-step-2-company")->name("register-step-2-company");

        Route::post("/company", [CompanyController::class, "register"])
            ->name("company.register");

        Route::view("/step-2-university", "register-step-2-university")
            ->name("register-step-2-university");

        Route::post("/step-2-university", [UniversityController::class, "store"])
            ->name("university.store");

        Route::view("/step-3", "register-step-3")->name("register-step-3");
    });

    Route::get("/auth", [AuthController::class, "showLogin"])->name("auth");
    // Compatibility route used by some views (welcome.blade)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::view("/students-in-search", "students-in-search")->name(
        "students-in-search",
    );

});

// Public API for students search (used by students-in-search page)
Route::get('/api/students', [App\Http\Controllers\StudentController::class, 'index'])
    ->name('api.students');

Route::prefix("auth")->group(function () {
    Route::post("/student", [AuthController::class, "studentLogin"])
        ->name("auth.student");

    Route::post("/company", [AuthController::class, "companyLogin"])
        ->name("auth.company");

    Route::post("/university", [AuthController::class, "universityLogin"])
        ->name("auth.university");
});

Route::post("/logout", [AuthController::class, "logout"])->name("logout");

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (USER AREA)
|--------------------------------------------------------------------------
*/

Route::middleware(["auth", "nocache"])->group(function () {

    Route::get("/profile/student", [AuthController::class, "studentProfile"])
        ->name("student-profile");

    Route::put("/student/{id}", [StudentController::class, "update"])
        ->name("student.update");

    Route::get("/profile/company", [AuthController::class, "companyProfile"])
        ->name("company-profile");

    Route::get("/profile/university", [AuthController::class, "universityProfile"])
        ->name("university-profile");

    Route::get('/profile/university/calendar', [CalendarController::class, 'index'])
        ->name('university.calendar');

    Route::get('/profile/company/calendar', [CalendarController::class, 'company'])
        ->name('company.calendar');

    Route::get("/profile/company/requests", [CompanyRequestController::class, "index"])
        ->name("profile.company-requests.index");

    Route::get("/profile/company/requests/create", [CompanyRequestController::class, "create"])
        ->name("profile.company-requests.create");

    Route::post("/profile/company/requests", [CompanyRequestController::class, "store"])
        ->name("profile.company-requests.store");

    Route::get("/profile/company/requests/{id}", [CompanyRequestController::class, "show"])
        ->name("profile.company-requests.show");

    Route::get("/profile/company/requests/{id}/edit", [CompanyRequestController::class, "edit"])
        ->name("profile.company-requests.edit");

    Route::put("/profile/company/requests/{id}", [CompanyRequestController::class, "update"])
        ->name("profile.company-requests.update");

    Route::delete("/profile/company/requests/{id}", [CompanyRequestController::class, "destroy"])
        ->name("profile.company-requests.destroy");

    // Documents upload for authenticated company/university users
    Route::post('/documents/upload', [\App\Http\Controllers\DocumentController::class, 'store'])
        ->name('documents.upload');

    // Options for student_internships available to current user (company/university)
    Route::get('/profile/documents/options', [\App\Http\Controllers\DocumentController::class, 'options'])
        ->name('profile.documents.options');

    Route::get('/documents/{id}/download', [\App\Http\Controllers\DocumentController::class, 'download'])
        ->name('documents.download');

    // Booking by company (authenticated users)
    Route::post('/reservations/book', [\App\Http\Controllers\ReservationController::class, 'store'])
        ->name('reservations.book');

    Route::delete('/reservations/{reservation}/cancel-by-company', [\App\Http\Controllers\ReservationController::class, 'cancelByCompany'])
        ->name('reservations.cancel-by-company');

    Route::get("/student/reservations", [StudentController::class, "reservations"])
        ->name("student.reservations");

    Route::delete("/reservations/{reservation}", [StudentController::class, "cancelReservation"])
        ->name("reservations.cancel");

    /*
    |--------------------------------------------------------------------------
    | PARTNERSHIPS PAGE
    |--------------------------------------------------------------------------
    */
    Route::get('/partnerships', [PartnershipController::class, 'index'])
        ->name('partnerships');

    Route::put('/profile/university', [AuthController::class, 'updateUniversityProfile'])
        ->name('profile.university.update');

    /*
    |--------------------------------------------------------------------------
    | CONTRACT REQUEST ACTIONS (FIX FOR 403)
    |--------------------------------------------------------------------------
    */

    Route::put('/contract-requests/{id}/accept-company', [ContractRequestController::class, 'acceptCompany'])
        ->name('contract-requests.accept-company');

    Route::put('/contract-requests/{id}/accept-university', [ContractRequestController::class, 'acceptUniversity'])
        ->name('contract-requests.accept-university');

    Route::put('/contract-requests/{id}/reject', [ContractRequestController::class, 'reject'])
        ->name('contract-requests.reject');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/internships', [InternshipController::class, 'index'])
    ->name('internships.index');

Route::get('/internships/create', [InternshipController::class, 'create'])
    ->name('internships.create');

Route::post('/internships/store', [InternshipController::class, 'store'])
    ->name('internships.store');

Route::put('/internships/{internship}', [InternshipController::class, 'update'])
    ->name('internships.update');

Route::delete('/internships/{internship}', [InternshipController::class, 'destroy'])
    ->name('internships.destroy');

Route::middleware([
    "auth",
    "nocache",
    \App\Http\Middleware\AdminMiddleware::class,
])->group(function () {

    Route::get("/admin", [AdminController::class, "index"])
        ->name("admin");

    Route::resources([
        "companies" => CompanyController::class,
        "universities" => UniversityController::class,
        "students" => StudentController::class,
        "directions" => DirectionController::class,
        "contracts" => ContractController::class,
        "reservations" => ReservationController::class,
        "documents" => DocumentController::class,
        "student-internships" => StudentInternshipController::class,
        "company-requests" => CompanyRequestController::class,
        "contract-requests" => ContractRequestController::class,
    ]);
});

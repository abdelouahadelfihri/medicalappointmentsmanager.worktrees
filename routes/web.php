<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Public)
|--------------------------------------------------------------------------
*/
Route::middleware(['web', 'guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('auth.showForgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('auth.sendResetLink');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('auth.showResetPassword');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.resetPassword');
});

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showEmailVerifyNotice'])->name('verification.notice');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['web'])->group(function () {
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');
});

Route::middleware(['web', 'auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/', fn() => view('dashboard'))->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('appointments', AppointmentController::class);

    // AJAX routes for modal add
    Route::post('/doctors/ajax-store', [DoctorController::class, 'ajaxStore'])
        ->name('doctors.ajaxStore');
    Route::post('patients/ajax-store', [PatientController::class, 'ajaxStore'])->name('patients.ajaxStore');
});
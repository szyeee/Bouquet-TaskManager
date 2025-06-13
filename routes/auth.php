<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER YANG BELUM LOGIN (guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Form register
    Route::get('register', [RegisteredUserController::class, 'create'])
         ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Form login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
         ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
         ->name('login');

    // Form lupa password
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
         ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
         ->name('password.email');

    // Form reset password
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
         ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
         ->name('password.store');
});

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER YANG SUDAH LOGIN (auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // (opsional) verifikasi email
    Volt::route('verify-email', 'pages.auth.verify-email')
         ->name('verification.notice');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
         ->middleware(['signed','throttle:6,1'])
         ->name('verification.verify');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
         ->name('logout');

    // Hanya SATU route dashboard di sini:
    Route::get('dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');
});

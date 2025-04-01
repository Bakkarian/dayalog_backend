<?php

use App\Http\Controllers\Auth\API\AuthenticatedSessionController;
use App\Http\Controllers\Auth\API\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\API\NewPasswordController;
use App\Http\Controllers\Auth\API\PasswordResetLinkController;
use App\Http\Controllers\Auth\API\RegisteredUserController;
use App\Http\Controllers\Auth\API\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

// Route::post('/login', [AuthenticatedSessionController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('login');


Route::post('/tokens/create', [AuthenticatedSessionController::class, 'getToken' ] )->middleware('guest')->name('get.token');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1']);

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth');


Route::post('login/by/system', [AuthenticatedSessionController::class, 'loginBySystem'])->name('login.by.system');
<?php

use App\Http\Controllers\UserRegistration;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserRegistration::class, 'registerForm']);

Route::get('register-form', [UserRegistration::class, 'registerForm']);
Route::post('register', [UserRegistration::class, 'store'])->name('store');

Route::get('login', [UserRegistration::class, 'loginview']);
Route::post('validate', [UserRegistration::class, 'validateLogin']);

Route::get('otp-verify', [UserRegistration::class, 'otpVerifyForm']);
Route::post('verify-otp', [UserRegistration::class, 'verifyOtp']);

Route::get('dashboard', [UserRegistration::class, 'dashboard']);
Route::post('logout', [UserRegistration::class, 'logout'])->name('logout');

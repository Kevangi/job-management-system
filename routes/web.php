<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\ForgotPasswordController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'form'])->name('login-form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register-form', [RegisterController::class, 'form'])->name('register-form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/forgot-password-form', [ForgotPasswordController::class, 'form'])->name('forgot-password-form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password-form/{token}', [ResetPasswordController::class, 'form'])->name('reset-password-form');
Route::post('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');

Route::get('/admin/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/employer/dashboard', function(){
    return view('employer.dashboard');
})->name('employer.dashboard');
Route::get('/jobSeeker/dashboard', function(){
    return view('jobSeeker.dashboard');
})->name('jobSeeker.dashboard');

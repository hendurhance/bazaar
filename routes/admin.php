<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

/**
 * Auth Routes
 */
Route::middleware('guest:admin_web')->group(function () {
    Route::view('/login', 'auth.admin.login')->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.handle');
    Route::view('/forgot-password', 'auth.admin.password.forgot')->name('forgot-password');
    // Route::post('/forgot-password', [App\Http\Controllers\Admin\Auth\PasswordController::class, 'forgotPassword'])->name('forgot-password.handle');
    // Route::get('/reset-password/{token}', [App\Http\Controllers\Admin\Auth\PasswordController::class, 'resetPasswordForm'])->name('reset-password');
});

Route::view('/', 'dashboard.admin.index')->name('dashboard');
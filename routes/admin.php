<?php

use App\Http\Controllers\Admin\Ad\AdController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\PasswordController;
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
    Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('forgot-password.handle');
    Route::get('/reset-password/{token}', [PasswordController::class, 'resetPasswordForm'])->name('reset-password');
    Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('reset-password.handle');
});


Route::middleware('auth:admin_web')->group(function () {
    Route::view('/', 'dashboard.admin.index')->name('dashboard');
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::get('/ads/pending', [AdController::class, 'pending'])->name('ads.pending');
    Route::get('/ads/upcoming', [AdController::class, 'upcoming'])->name('ads.upcoming');
    Route::get('/ads/rejected', [AdController::class, 'rejected'])->name('ads.rejected');
    Route::get('/ads/expired', [AdController::class, 'expired'])->name('ads.expired');
    Route::get('/ads/active', [AdController::class, 'active'])->name('ads.active');
    Route::get('/ads/reported', [AdController::class, 'reported'])->name('ads.reported');
    Route::get('/ad/{ads:slug}/report', [AdController::class, 'reportAd'])->name('ads.reported.show');
    Route::get('/ad/{ads:slug}', [AdController::class, 'show'])->name('ads.show');
    Route::get('/ad/{ads:slug}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ad/{ads:slug}/edit', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ad/{ads:slug}/', [AdController::class, 'destroy'])->name('ads.destroy');
});
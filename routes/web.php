<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\PasswordController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Page Routes
 */
Route::view('/', 'pages.index')->name('index');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/live-auction', 'pages.live-auction')->name('live-auction');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('blog-details', 'pages.blog-details')->name('blog-details');
Route::view('auction-details', 'pages.auction-details')->name('auction-details');

/**
 * User Routes
 */
Route::group([
    'as' => 'user.',
], function () {
    Route::middleware('guest')->group(function () {
        Route::view('/login', 'user.auth.login')->name('login');
        Route::view('/register', 'user.auth.register')->name('register');
        Route::view('/forgot-password', 'user.auth.forgot-password')->name('forgot-password');
        Route::get('/reset-password/{token}', [PasswordController::class, 'resetPasswordForm'])->name('reset-password');
        Route::get('/verify-email/{token}', [RegisterController::class, 'verify'])->name('verify-email');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.handle');
        Route::post('/login', [LoginController::class, 'login'])->name('login.handle');
        Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('forgot-password.handle');
        Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('reset-password.handle');
    });
});

<?php

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

Route::view('/', 'pages.index')->name('index');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/live-auction', 'pages.live-auction')->name('live-auction');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('blog-details', 'pages.blog-details')->name('blog-details');
Route::view('auction-details', 'pages.auction-details')->name('auction-details');

/**
 * User Authentication Routes
 */
Route::middleware('guest')->group(function () {
    Route::view('/login', 'user.auth.login')->name('user.login');
    Route::view('/register', 'user.auth.register')->name('user.register');
    Route::view('/forgot-password', 'user.auth.forgot-password')->name('user.forgot-password');
});
<?php

use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\User\Ad\AdController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\PasswordController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Bid\BidController;
use App\Http\Controllers\User\Payment\PaymentController;
use App\Http\Controllers\User\Payout\PayoutController;
use App\Http\Controllers\User\Payout\PayoutMethodController;
use App\Http\Controllers\User\Profile\ProfileController;
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
Route::get(uri: '/', action: HomeController::class)->name('home');
Route::view('/about', 'pages.about.index')->name('about');
Route::view('/contact', 'pages.contact.index')->name('contact');
Route::view('/how-it-works', 'pages.how-it-works.index')->name('how-it-works');
Route::get('/live-auction', [AdController::class, 'index'])->name('live-auction');
Route::view('/blog', 'pages.blog.index')->name('blog');
Route::view('blog-details', 'pages.blog.show')->name('blog-details');
Route::get('auction-details/{ads:slug}', [AdController::class, 'show'])->name('auction-details');
Route::get('auction-details/{ads:slug}/report', [AdController::class, 'report'])->name('auction-details.report');
Route::post('auction-details/{ads:slug}/report', [AdController::class, 'handleReport'])->name('auction-details.report.handle');
Route::view('/add-listing', 'pages.live-auction.create')->name('add-listing');
Route::post('/add-listing', [AdController::class, 'store'])->name('add-listing.handle');
Route::post('/bid/{ads:slug}', [BidController::class, 'bid'])->name('bid.handle')->middleware('auth:web');
/**
 * User Routes
 */
Route::group([
    'as' => 'user.',
], function () {
    Route::middleware('guest')->group(function () {
        Route::view('/login', 'auth.user.login')->name('login');
        Route::view('/register', 'auth.user.register')->name('register');
        Route::view('/forgot-password', 'auth.user.password.forgot')->name('forgot-password');
        Route::get('/reset-password/{token}', [PasswordController::class, 'resetPasswordForm'])->name('reset-password');
        Route::get('/verify-email/{token}', [RegisterController::class, 'verify'])->name('verify-email');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.handle');
        Route::post('/login', [LoginController::class, 'login'])->name('login.handle');
        Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('forgot-password.handle');
        Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('reset-password.handle');
    });

    Route::middleware('auth:web')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout.handle');
        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.handle');
        Route::get('/ads', [AdController::class, 'userAds'])->name('ads');
        Route::get('/ads/{ads:slug}', [AdController::class, 'showUserAd'])->name('ads.show');
        Route::get('/ads/{ads:slug}/edit', [AdController::class, 'editUserAd'])->name('ads.edit');
        Route::put('/ads/{ads:slug}/edit', [AdController::class, 'updateUserAd'])->name('ads.edit.handle');
        Route::post('/ads/{ads:slug}/bids/{bids:id}/accept', [BidController::class, 'acceptBid'])->name('ads.bids.accept');
        Route::get('/listing-bids', [BidController::class, 'index'])->name('listing-bids');
        Route::get('/listing-bids/{bids:id}', [BidController::class, 'show'])->name('listing-bids.show');
        Route::post('/pay/{bids:id}', [PaymentController::class, 'pay'])->name('pay');
        Route::get('/confirm-payment/{payments:txn_id}', [PaymentController::class, 'confirm'])->name('confirm-payment');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
        Route::get('/payments/{payments:txn_id}', [PaymentController::class, 'show'])->name('payments.show');
        Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts');
        Route::get('/payouts/{payments:txn_id}', [PayoutController::class, 'show'])->name('payouts.show');
        Route::post('/payouts/{payments:txn_id}/request', [PayoutController::class, 'request'])->name('payouts.request');
        Route::resource('/payout-methods', PayoutMethodController::class)->except(['show']);
    });
});
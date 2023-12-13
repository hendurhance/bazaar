<?php

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

/**
 * User Routes
 */
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

Route::middleware(['auth:web', 'ensure.account.active'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout.handle');
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/resend-verification-email', [RegisterController::class, 'resendVerificationEmail'])->name('resend-verification-email');

    // Route restrictions for unverified users
    Route::middleware(['ensure.email.verified'])->group(function () {
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

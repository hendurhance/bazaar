<?php

use App\Http\Controllers\Admin\Ad\AdController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Bid\BidController;
use App\Http\Controllers\Admin\Payment\PaymentController;
use App\Http\Controllers\Admin\Payout\PayoutController;
use App\Http\Controllers\Admin\Payout\PayoutMethodController;
use App\Http\Controllers\Admin\Post\CommentController;
use App\Http\Controllers\Admin\Post\PostController;
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

    /* ========  ADS  =========== */
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

    /* ========  BIDS  =========== */
    Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
    Route::get('/bids/{bids:id}', [BidController::class, 'show'])->name('bids.show');

    /* ========  PAYOUT METHOD  =========== */
    Route::get('/payout-methods', [PayoutMethodController::class, 'index'])->name('payout-methods.index');
    Route::get('/payout-methods/{payoutMethods:id}', [PayoutMethodController::class, 'show'])->name('payout-methods.show');

    /* ========  PAYMENTS  =========== */
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/pending', [PaymentController::class, 'pending'])->name('payments.pending');
    Route::get('/payments/success', [PaymentController::class, 'success'])->name('payments.success');
    Route::get('/payments/failed', [PaymentController::class, 'failed'])->name('payments.failed');
    Route::get('/payment/{payments:txn_id}', [PaymentController::class, 'show'])->name('payments.show');
    Route::patch('/payment/{payments:txn_id}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.update.status');

    /* ======== PAYOUTS  ======== */
    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('/payouts/pending', [PayoutController::class, 'pending'])->name('payouts.pending');
    Route::get('/payouts/success', [PayoutController::class, 'success'])->name('payouts.success');
    Route::get('/payouts/failed', [PayoutController::class, 'failed'])->name('payouts.failed');
    Route::get('/payout/{payouts:pyt_token}', [PayoutController::class, 'show'])->name('payouts.show');

    /* ========  BLOGS  =========== */
    Route::resource('blogs', PostController::class);
    Route::post('/blogs/{post:slug}/comment', [CommentController::class, 'store'])->name('blogs.comment.store');
    Route::resource('comments', CommentController::class)->only(['index', 'update', 'edit', 'destroy']);
});

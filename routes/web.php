<?php

use App\Http\Controllers\Page\BlogController;
use App\Http\Controllers\Page\CommentController;
use App\Http\Controllers\Page\ContactController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\User\Ad\AdController;
use App\Http\Controllers\User\Bid\BidController;
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
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/how-it-works', 'pages.how-it-works.index')->name('how-it-works');
Route::get('/live-auction', [AdController::class, 'index'])->name('live-auction');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{post:slug}/comment', [CommentController::class, 'store'])->name('blog.comment.store');
Route::get('/auction-details/{ads:slug}', [AdController::class, 'show'])->name('auction-details')->middleware('increase.ad.views');
Route::get('/auction-details/{ads:slug}/report', [AdController::class, 'report'])->name('auction-details.report');
Route::post('/auction-details/{ads:slug}/report', [AdController::class, 'handleReport'])->name('auction-details.report.handle');
Route::view('/add-listing', 'pages.live-auction.create')->name('add-listing');
Route::post('/add-listing', [AdController::class, 'store'])->name('add-listing.handle');
Route::post('/bid/{ads:slug}', [BidController::class, 'bid'])->name('bid.handle')->middleware('auth:web');
Route::webhooks('paystack-webhook', 'paystack-webhook');
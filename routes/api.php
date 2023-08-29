<?php

use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\CountryController as ApiCountryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/subcategories/{slug}', [ApiCategoryController::class, 'getSubCategories'])->name('categories.sub-categories');

Route::get('/states/{iso2code}', [ApiCountryController::class, 'getStates'])->name('countries.states');
Route::get('/cities/{iso2code}/{stateCode}', [ApiCountryController::class, 'getCities'])->name('countries.cities');
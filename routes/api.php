<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\CatalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Авторизация и регистрация
Route::group(['prefix' => 'auth'], function () {
    Route::middleware(['guest', 'throttle:5'])->group(function () {
        Route::post('login', SignInController::class);
        Route::post('register', SignUpController::class);
    });
});

// Каталог только для авторизованных
Route::middleware(['auth:api', 'filter'])->group(function () {
     Route::get('catalog', CatalogController::class)->name('catalog');
});

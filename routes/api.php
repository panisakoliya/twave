<?php

use App\Http\Controllers\API\LoginAPIController;
use App\Http\Controllers\API\RegisterAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [LoginAPIController::class, 'login']);
    Route::post('register', [RegisterAPIController::class, 'register']);
    Route::post('forgot-password', [UserAPIController::class, 'forgotPassword']);

    Route::get('users', [UserController::class, 'usersAPI']);
    Route::get('categories', [CategoryController::class, 'categoriesAPI']);
    Route::get('products', [ProductController::class, 'productsAPI']);
    Route::get('heros', [HeroController::class, 'herosAPI']);
});

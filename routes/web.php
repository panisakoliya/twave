<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('home', function () {
    return redirect()->route('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    /**** Admin panel routes ****/
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::post('delete', [UserController::class, 'delete'])->name('delete');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('edit', [UserController::class, 'edit'])->name('edit');
            Route::post('update', [UserController::class, 'update'])->name('update');
        });
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('create', [OrderController::class, 'create'])->name('create');
        Route::post('store', [OrderController::class, 'store'])->name('store');
        Route::post('delete', [OrderController::class, 'delete'])->name('delete');
        Route::group(['prefix' => '{order}'], function () {
            Route::get('edit', [OrderController::class, 'edit'])->name('edit');
            Route::post('update', [OrderController::class, 'update'])->name('update');
        });
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::post('delete', [ProductController::class, 'delete'])->name('delete');
        Route::group(['prefix' => '{product}'], function () {
            Route::get('edit', [ProductController::class, 'edit'])->name('edit');
            Route::post('update', [ProductController::class, 'update'])->name('update');
        });
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::post('delete', [CategoryController::class, 'delete'])->name('delete');
        Route::group(['prefix' => '{category}'], function () {
            Route::get('edit', [CategoryController::class, 'edit'])->name('edit');
            Route::post('update', [CategoryController::class, 'update'])->name('update');
        });
    });

    Route::group(['prefix' => 'hero', 'as' => 'hero.'], function () {
        Route::get('/', [HeroController::class, 'index'])->name('index');
        Route::get('create', [HeroController::class, 'create'])->name('create');
        Route::post('store', [HeroController::class, 'store'])->name('store');
        Route::post('delete', [HeroController::class, 'delete'])->name('delete');
        Route::group(['prefix' => '{hero}'], function () {
            Route::get('edit', [HeroController::class, 'edit'])->name('edit');
            Route::post('update', [HeroController::class, 'update'])->name('update');
        });
    });
});

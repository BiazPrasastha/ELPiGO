<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthController;


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

Route::get('/', function () {
    return redirect()->route('index');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', [AuthController::class, 'index_register']);

Route::middleware(['isLogin'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/change-password', [AuthController::class, 'change']);
    Route::get('/change-password', [AuthController::class, 'password']);

    Route::prefix('district')->group(function () {
        Route::get('/', [DistrictController::class, 'index']);
        Route::middleware(['isAdmin'])->group(function () {
            Route::get('/create', [DistrictController::class, 'create']);
            Route::post('/store', [DistrictController::class, 'store']);
            Route::get('/{id}/edit', [DistrictController::class, 'edit']);
            Route::post('/{id}/update', [DistrictController::class, 'update']);
            Route::get('/{id}/destroy', [DistrictController::class, 'destroy']);
        });
    });

    Route::prefix('citizen')->group(function () {
        Route::get('/', [CitizenController::class, 'index']);
        Route::middleware(['isAdmin'])->group(function () {
            Route::get('/create', [CitizenController::class, 'create']);
            Route::post('/store', [CitizenController::class, 'store']);
            Route::get('/{id}/edit', [CitizenController::class, 'edit']);
            Route::post('/{id}/update', [CitizenController::class, 'update']);
            Route::get('/{id}/destroy', [CitizenController::class, 'destroy']);
        });
    });

    Route::prefix('promo')->group(function () {
        route::get('/', [PromoController::class, 'index']);
        Route::middleware(['isAdmin'])->group(function () {
            Route::get('/create', [PromoController::class, 'create']);
            Route::post('/store', [PromoController::class, 'store']);
            Route::get('/{id}/edit', [PromoController::class, 'edit']);
            Route::post('/{id}/update', [PromoController::class, 'update']);
            Route::get('/{id}/destroy', [PromoController::class, 'destroy']);
        });
    });

    Route::middleware(['isUser'])->group(function () {
        Route::prefix('inventory')->group(function () {
            Route::get('/', [InventoryController::class, 'index']);
            Route::get('/create', [InventoryController::class, 'create']);
            Route::post('/store', [InventoryController::class, 'store']);
            Route::get('/{id}/edit', [InventoryController::class, 'edit']);
            Route::post('/{id}/update', [InventoryController::class, 'update']);
            Route::get('/{id}/destroy', [InventoryController::class, 'destroy']);
        });

        Route::prefix('report')->group(function () {
            Route::get('/', [OrderController::class, 'show']);
            Route::get('/print', [OrderController::class, 'print']);
        });

        Route::prefix('order')->group(function () {
            Route::get('/subsidi', [OrderController::class, 'index_subsidi'])->name('index');
            Route::get('/non-subsidi', [OrderController::class, 'index_non_subsidi']);
            Route::get('/store', [OrderController::class, 'store']);
            Route::post('/invoice', [OrderController::class, 'invoice']);
        });
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('store')->group(function () {
            Route::get('/', [StoreController::class, 'index']);
        });
    });
});

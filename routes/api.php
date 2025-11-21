<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| PUBLIC API ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('public')->group(function () {

    // Public Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('{id}', [ProductController::class, 'show']);
        Route::get('category/{categoryId}', [ProductController::class, 'byCategory']);
        Route::get('search/{keyword}', [ProductController::class, 'search']);
    });

    // Public Categories
    Route::apiResource('categories', CategoryController::class)
        ->only(['index', 'show']);

    // public promos
    Route::apiResource('promo', PromoController::class)
        ->only(['index', 'show']);
});


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED API ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {

        // Products (Admin CRUD + custom actions)
        Route::prefix('products')->group(function () {
            Route::post('{id}/thumbnail', [ProductController::class, 'updateThumbnail']);
        });

        Route::apiResource('products', ProductController::class)
            ->only(['store', 'update', 'destroy']);

        // Category CRUD
        Route::apiResource('categories', CategoryController::class)
            ->only(['store', 'update', 'destroy']);

        // User R
        Route::apiResource('addresses', AddressController::class)->only(['index', 'show']);

        // Promo CRUD
        Route::apiResource('promo', PromoController::class)->except(['index', 'show']);

        // Order CRUD
        Route::prefix('admin')->middleware('auth:admin')->group(function () {
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{id}', [OrderController::class, 'show']);
        Route::post('orders', [OrderController::class, 'store']);
        Route::put('orders/{id}', [OrderController::class, 'update']);
        Route::delete('orders/{id}', [OrderController::class, 'destroy']);
});



    });


/*
|--------------------------------------------------------------------------
| USER PROTECTED API ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:user')
    ->prefix('user')
    ->group(function () {

        // User Addresses
        Route::apiResource('addresses', AddressController::class);

        // Extra endpoint: select default address
        Route::post('addresses/{id}/select', [AddressController::class, 'select']);
        Route::prefix('user')->middleware('auth:user')->group(function () {
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{id}', [OrderController::class, 'show']);
        Route::post('orders', [OrderController::class, 'store']);
        Route::put('orders/{id}', [OrderController::class, 'update']);
        Route::delete('orders/{id}', [OrderController::class, 'destroy']);
});
    });

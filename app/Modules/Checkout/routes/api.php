<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Checkout\Http\Controllers\CartController;
use App\Modules\Checkout\Http\Controllers\CartItemController;

// Auth User Routes
Route::group(['middleware' => 'auth:api','prefix' => 'api'], function () {
    Route::get('cart-items', [CartItemController::class, 'index']);
    Route::post('cart-items', [CartItemController::class, 'store']);
    Route::delete('cart-items/{id}', [CartItemController::class, 'destroy']);
    Route::post('add-guest-items-to-user-cart', [CartItemController::class, 'addGuestItemsToUserCart']);

    Route::post('cart', [CartController::class, 'store']);
});

// Guest User Routes
Route::group(['prefix' => 'api'], function () {
    Route::get('guest/cart-items', [CartItemController::class, 'index']);
    Route::post('guest/cart', [CartController::class, 'guestStore']);
});


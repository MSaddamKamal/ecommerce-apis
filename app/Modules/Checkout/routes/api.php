<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Checkout\Http\Controllers\CartController;
use App\Modules\Checkout\Http\Controllers\CartItemController;

// Auth User Routes
Route::group(['middleware' => 'auth:api','prefix' => 'api'], function () {
    // Cart Items Route
    Route::get('cart-items', [CartItemController::class, 'index']);
    Route::post('cart-items', [CartItemController::class, 'store']);
    Route::delete('cart-items/{id}', [CartItemController::class, 'destroy']);
    Route::post('add-guest-items-to-user-cart', [CartItemController::class, 'addGuestItemsToUserCart']);
    // Cart Route
    Route::post('cart', [CartController::class, 'store']);
});

// Guest User Routes
Route::group(['prefix' => 'api'], function () {
    // Cart Items Route
    Route::get('guest/cart-items', [CartItemController::class, 'index']);
    Route::delete('guest/cart-items/{id}', [CartItemController::class, 'destroy']);
    // Cart Route
    Route::post('guest/cart', [CartController::class, 'guestStore']);
});


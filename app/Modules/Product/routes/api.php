<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Product\Http\Controllers\ProductController;

// Auth User Routes
Route::group(['middleware' => 'auth:api','prefix' => 'api'], function () {
    Route::apiResource('products',ProductController::class);
});

// Guest User Routes
Route::group(['prefix' => 'api'], function () {
    Route::get('guest/products', [ProductController::class, 'guestIndex']);
});


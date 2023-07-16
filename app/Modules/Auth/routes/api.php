<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Http\Controllers\AuthController;

// Routes For Auth
Route::group(['prefix' => 'api/auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    // With Auth Middleware
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Analytics\Http\Controllers\AnalyticsController;

Route::group(['middleware' => 'auth:api','prefix' => 'api'], function () {
    Route::post('analytics', [AnalyticsController::class, 'store']);
});

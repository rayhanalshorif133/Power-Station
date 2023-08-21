<?php

use App\Http\Controllers\Api\RecommendationController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->name('recommendation.')
    ->group(function () {
        Route::get('/recommendation/{id?}', [RecommendationController::class, 'fetchRecommendation'])->name('fetch-recommendation');
        Route::post('/recommendation/create', [RecommendationController::class, 'store'])->name('store');
    });

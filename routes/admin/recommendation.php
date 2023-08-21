<?php

use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('role:admin')
    ->name('recommendation.')
    ->prefix('recommendation/')
    ->controller(RecommendationController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('{id}/fetch-recommendation-by-id', 'fetchRecommendationById')->name('fetchRecommendationById');
    });

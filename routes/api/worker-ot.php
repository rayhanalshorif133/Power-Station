<?php

use App\Http\Controllers\Api\WorkerOTController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')
    ->name('worker-over-time.')
    ->prefix('worker-over-time')
    ->controller(WorkerOTController::class)
    ->group(function () {
        Route::get('/{id?}', 'fetch')->name('fetch');
        Route::get('filter/{filterName?}', 'fetchFilter')->name('fetch-filter');
        Route::post('/create', 'store')->name('store');
    });





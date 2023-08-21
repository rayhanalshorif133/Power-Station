<?php

use App\Http\Controllers\WorkerOTController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->name('worker-over-time.')
    ->prefix('worker-over-time/')
    ->controller(WorkerOTController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });

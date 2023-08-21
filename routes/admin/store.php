<?php

use App\Http\Controllers\DeviceStockController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->name('store.')
    ->prefix('stock/')
    ->controller(DeviceStockController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

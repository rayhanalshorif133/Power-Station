<?php

use App\Http\Controllers\DeviceStockController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->name('device-stock.')
    ->prefix('device-stock/')
    ->controller(DeviceStockController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');
    });

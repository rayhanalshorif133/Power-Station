<?php

use App\Http\Controllers\Api\DeviceStockController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->controller(DeviceStockController::class)
    ->name('device.stock.')
    ->prefix('device/stock/')
    ->group(function () {
        Route::get('/{id?}', 'fetch')->name('fetch');
        Route::post('create', 'create')->name('create');
        Route::post('update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');
    });

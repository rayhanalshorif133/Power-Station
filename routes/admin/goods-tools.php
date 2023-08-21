<?php

use App\Http\Controllers\GoodsToolsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->name('goods-tools.')
    ->prefix('goods-tools/')
    ->controller(GoodsToolsController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('{id}/show', 'show')->name('show');
        // fech others by id:Start
        Route::get('fetchDevices/{id}/byCategoryId', 'fetchDeviceByCategoryId')->name('fetchDeviceByCategoryId');
        Route::get('fetchRacks/{id}/byRoomId', 'fetchRackByRoomId')->name('fetchRackByRoomId');
        // Route::get('fetchDevices/{id}/byModelId', 'fetchDeviceByModelId')->name('fetchDeviceByModelId');
        // fech others by id:End
        Route::get('{id}/fetch', 'fetch')->name('fetch');
        Route::post('store', 'store')->name('store');
        Route::post('update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');
    });

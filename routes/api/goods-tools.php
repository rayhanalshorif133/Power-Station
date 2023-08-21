<?php

use App\Http\Controllers\Api\GoodsToolsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->name('goods-tools.')
    ->prefix('goods-tools/')
    ->controller(GoodsToolsController::class)
    ->group(function () {
        Route::get('/{id?}', 'fetch')->name('fetch');
        Route::get('/filter/{filter?}', 'fetchWithFilter')->name('fetch-with-filter');
        // fech others by id:Start
        Route::get('fetchDevices/{id}/byCategoryId', 'fetchDeviceByCategoryId')->name('fetchDeviceByCategoryId');
        Route::get('fetchRacks/{id}/byRoomId', 'fetchRackByRoomId')->name('fetchRackByRoomId');
        Route::get('fetchShelf/{roomId}/{rackNumber}/byRoomAndRackId', 'fetchShelfByRoomAndRackId')->name('fetchShelfByRoomAndRackId');
        // fech others by id:End
        Route::post('create', 'store')->name('store');
        Route::post('update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');

        // goods-tools logs
        Route::get('/fetch/logs/{id?}', 'fetchGoodsToolsLogs')->name('fetch-logs');
    });

<?php

use App\Http\Controllers\Api\RoomController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')
    ->name('room.')
    ->prefix('room')
    ->controller(RoomController::class)
    ->group(function () {
        Route::get('/{id?}', 'fetch')->name('fetch');
        Route::get('/filter/{name?}', 'filterByRoomName')->name('filterByRoomName');
        Route::post('/create', 'store')->name('store');
        // Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/{id}/delete', 'destroy')->name('destroy');
    });





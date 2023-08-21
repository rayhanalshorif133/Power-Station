<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->name('room.')
    ->prefix('room/')
    ->controller(RoomController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('{id}/view', 'view')->name('view');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');
    });

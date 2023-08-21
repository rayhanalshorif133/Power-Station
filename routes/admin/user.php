<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->name('user.')
    ->prefix('user/')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('pending', 'pendingUserIndex')->name('pending.index');
        Route::get('deactive', 'deactiveUserIndex')->name('deactive.index');
        Route::get('{id}/view', 'view')->name('view');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::get('create', 'create')->name('create');
        Route::get('fetch-users', 'fetchUsers')->name('fetch-Users');
        Route::post('store', 'store')->name('store');
        Route::post('update', 'update')->name('update');
        Route::post('action-update', 'actionUpdate')->name('actionUpdate');
        Route::post('status-update', 'userStatusUpdate')->name('status.update');
    });

<?php

use App\Http\Controllers\ShiftEngineerController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->name('shift-engineer.')
    ->prefix('shift-engineer/')
    ->controller(ShiftEngineerController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/view-and-edit', 'viewAndEdit')->name('viewAndEdit');
        Route::post('fetch/user-name', 'fetchUserName')->name('fetchUserName');
        Route::post('store', 'store')->name('store');
        Route::post('update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');
    });

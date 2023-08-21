<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->name('department.')
    ->prefix('department/')
    ->controller(DepartmentController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('fetch-all', 'fetchAllDepartment')->name('fetchAllDepartment');
        Route::post('store', 'store')->name('store');
        Route::post('action-update', 'actionUpdate')->name('actionUpdate');
        Route::delete('{id}/delete', 'delete')->name('delete');
        // User Assign to the Department
        Route::post('assign-user', 'assignUser')->name('assignUser');
        Route::get('/{id}/fetch-assign-user', 'fetchAssignUser')->name('fetchAssignUser');
    });

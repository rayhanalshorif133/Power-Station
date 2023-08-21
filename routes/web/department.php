<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;




Route::name('public.department.')
    ->prefix('public/department/')
    ->controller(DepartmentController::class)
    ->group(function () {
        Route::get('/', 'publicIndex')->name('publicIndex');
    });

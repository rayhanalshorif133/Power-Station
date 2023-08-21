<?php

use App\Http\Controllers\ReturnDeviceController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')
    ->name('return-device.')
    ->prefix('return-device/')
    ->controller(ReturnController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
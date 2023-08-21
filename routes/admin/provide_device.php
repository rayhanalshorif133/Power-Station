<?php

use App\Http\Controllers\ProvideDeviceController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')
    ->name('provide-device.')
    ->prefix('provide-device/')
    ->controller(ProvideDeviceController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
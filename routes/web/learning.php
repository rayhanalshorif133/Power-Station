<?php

use App\Http\Controllers\LearningController;
use Illuminate\Support\Facades\Route;




Route::name('public.learning.')
    ->prefix('public/learning/')
    ->controller(LearningController::class)
    ->group(function () {
        Route::get('/', 'publicIndex')->name('publicIndex');
        Route::get('/dashboard', 'publicDashboard')->name('publicDashboard');
        Route::get('/device-status-list', 'publicDeviceStatusList')->name('publicDeviceStatusList');
        Route::get('{id}/device-details', 'publicDeviceDetails')->name('publicDeviceDetails');
    });
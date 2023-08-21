<?php

use App\Http\Controllers\Api\DeviceScheduleController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->controller(DeviceScheduleController::class)
    ->group(function () {
        Route::post('device/schedule/create', 'create')->name('device.schedule.create');
    });

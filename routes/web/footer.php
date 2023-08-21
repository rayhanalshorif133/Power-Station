<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;




Route::name('public.footer.')
    ->prefix('public/footer/')
    ->group(function () {
        Route::get('fetch-devices', [DeviceController::class, 'fetchFooterDevice'])->name('fetch-footer-device');
    });
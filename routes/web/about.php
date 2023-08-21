<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;



Route::name('public.about.')
    ->prefix('public/about/')
    ->controller(AboutController::class)
    ->group(function () {
        Route::get('/', 'publicIndex')->name('publicIndex');
    });
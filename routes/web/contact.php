<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;




Route::name('public.contact.')
    ->prefix('public/contact/')
    ->controller(ContactController::class)
    ->group(function () {
        Route::get('/', 'publicIndex')->name('publicIndex');
    });
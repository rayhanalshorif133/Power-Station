<?php

use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')
    ->name('notice.')
    ->prefix('notice/')
    ->controller(NoticeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('{id}/publication-update', 'publicationUpdate')->name('publicationUpdate');
    });
<?php

use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Route;



Route::name('public.notice.')
    ->prefix('public/notice/')
    ->controller(NoticeController::class)
    ->group(function () {
        Route::get('/', 'publicIndex')->name('publicIndex');
        Route::get('{id}/view-file', 'viewFile')->name('viewFile');
    });
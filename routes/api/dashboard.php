<?php

use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('index');
    });
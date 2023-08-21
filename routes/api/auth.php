<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest:sanctum')
    ->group(function () {
        Route::post('/user-login', [AuthController::class, 'userLogin'])->name('user-login');
        Route::get('/user-fetch-roles', [AuthController::class, 'fetchRoles'])->name('user-fetch-roles');
        Route::post('/user-register', [AuthController::class, 'userRegister'])->name('user-register');
    });
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/user-info/{id?}', [AuthController::class, 'userInfo'])->name('userInfo');
        Route::get('/auth-user-info', [AuthController::class, 'authUserInfo'])->name('auth-user-info');
    });

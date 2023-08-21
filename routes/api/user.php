<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/users', [UserController::class, 'fetchUsers'])->name('fetch-users');
        Route::get('/user/{id}', [UserController::class, 'fetchUser'])->name('fetch-user');
        Route::post('/user/update', [UserController::class, 'update'])->name('user-update');
        Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('destroy');
    });

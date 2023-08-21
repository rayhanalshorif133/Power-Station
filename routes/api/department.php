<?php

use App\Http\Controllers\Api\DepartmentController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::name('department.')
    ->group(function () {
        Route::get('/departments', [DepartmentController::class, 'fetchDepartments'])->name('fetchDepartments');
        Route::get('/department/{id}', [DepartmentController::class, 'fetchDepartment'])->name('fetchDepartment');
    });
    
Route::middleware('auth:sanctum')
    ->name('department.')
    ->group(function () {
        Route::post('/department-create', [DepartmentController::class, 'store'])->name('store');
        Route::post('/department/update', [DepartmentController::class, 'update'])->name('update');
        Route::post('/department/assign-user', [DepartmentController::class, 'assignUser'])->name('assign-user');
        Route::delete('/department/{id}/delete', [DepartmentController::class, 'destroy'])->name('destroy');
    });

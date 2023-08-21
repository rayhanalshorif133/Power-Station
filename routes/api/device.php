<?php

use App\Http\Controllers\Api\DeviceMainDeviceController;
use App\Http\Controllers\Api\DeviceStatusController;
use App\Http\Controllers\Api\DeviceSectionController;
use App\Http\Controllers\Api\DeviceAreaController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\DeviceCategoryController;
use App\Http\Controllers\Api\DeviceScheduleController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->name('device.')
    ->prefix('device/')
    ->controller(DeviceController::class)
    ->group(function () {
        Route::get('/', 'fetchDevice')->name('fetchDevice');
        Route::post('create', 'create')->name('create');
    });


Route::name('device.')
    ->prefix('device/')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Device Category Routes
        |--------------------------------------------------------------------------
        */
        Route::get('category/{id?}', [DeviceCategoryController::class,'fetchCategory'])
                ->name('category.fetchCategory');
        Route::middleware('auth:sanctum')
            ->controller(DeviceCategoryController::class)
            ->name('category.')
            ->prefix('category/')
            ->group(function () {
                Route::post('create', 'create')->name('create');
                Route::post('{id}/update', 'update')->name('update');
                Route::delete('{id}/delete', 'delete')->name('delete');
            });
        /*
        |--------------------------------------------------------------------------
        | Device Area Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceAreaController::class)
            ->name('area.')
            ->prefix('area/')
            ->group(function () {
                Route::get('/', 'fetchAll')->name('fetch-all');
                Route::get('{id}', 'fetchAreaById')->name('fetch');
            });
        /*
        |--------------------------------------------------------------------------
        | Device Section Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceSectionController::class)
            ->name('section.')
            ->prefix('section/')
            ->group(function () {
                Route::get('/', 'fetchAll')->name('fetch-all');
                Route::get('{id}', 'fetchAreaById')->name('fetch');
            });
        /*
        |--------------------------------------------------------------------------
        | Device Status Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceStatusController::class)
            ->name('status.')
            ->prefix('status/')
            ->group(function () {
                Route::get('/', 'fetchAll')->name('fetch-all');
                Route::get('{id}', 'fetch')->name('fetch');
                // Route::post('store', 'store')->name('store');
                // Route::post('update', 'update')->name('update');
                // Route::delete('{id}/delete', 'delete')->name('delete');
            });
        /*
        |--------------------------------------------------------------------------
        | Device Main Device Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceMainDeviceController::class)
            ->name('main-device.')
            ->prefix('main-device/')
            ->group(function () {
                Route::get('/', 'fetchAll')->name('fetch-all');
                Route::get('{id}', 'fetch')->name('fetch');
                // Route::post('store', 'store')->name('store');
                // Route::post('update', 'update')->name('update');
                // Route::delete('{id}/delete', 'delete')->name('delete');
            });
        /*
        |--------------------------------------------------------------------------
        | Device Main Device Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceScheduleController::class)
            ->name('schedule.')
            ->prefix('schedule/')
            ->group(function () {
                Route::get('{id?}', 'fetch')->name('fetch');
                Route::post('create', 'create')->name('create');
                // Route::post('update', 'update')->name('update');
                // Route::delete('{id}/delete', 'delete')->name('delete');
            });
    });

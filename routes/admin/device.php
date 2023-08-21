<?php

use App\Http\Controllers\DeviceMainDeviceController;
use App\Http\Controllers\DeviceStatusController;
use App\Http\Controllers\DeviceSectionController;
use App\Http\Controllers\DeviceAreaController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceCategoryController;
use App\Http\Controllers\DeviceHistoryLogController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->name('device.')
    ->prefix('device/')
    ->group(function () {
        Route::controller(DeviceController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('{id}/show', 'show')->name('show');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::post('{id}/update', 'update')->name('update');
                Route::post('update-status', 'updateStatus')->name('update-status');
                Route::get('{id}/fetch-device-by-id', 'fetchDeviceById')->name('fetchDeviceById');
                
                // Delete
                Route::post('/delete/image-one-by-one', 'deleteImageOneByOne')->name('deleteImageOneByOne');
                Route::delete('{id}/delete', 'delete')->name('delete');
                Route::post('multi-selected-device/delete', 'multiDeviceDelete')->name('delete');
            });
        /*
        |--------------------------------------------------------------------------
        | Device Logs / History Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceHistoryLogController::class)
            ->name('logs.')
            ->prefix('logs/')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                // Route::post('store', 'store')->name('store');
                // Route::post('update', 'update')->name('update');
                // Route::delete('{id}/delete', 'destroy')->name('delete');
                // Route::post('delete-selected', 'destroySelected')->name('destroy.selected');
            });

        /*
        |--------------------------------------------------------------------------
        | Device Category Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(DeviceCategoryController::class)
            ->name('category.')
            ->prefix('category/')
            ->group(function () {
                Route::get('index', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::post('update', 'update')->name('update');
                Route::delete('{id}/delete', 'destroy')->name('delete');
                Route::post('delete-selected', 'destroySelected')->name('destroy.selected');
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
                Route::get('index', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::post('update', 'update')->name('update');
                Route::delete('{id}/delete', 'destroy')->name('delete');
                Route::post('delete-selected', 'destroySelected')->name('destroy.selected');
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
                Route::get('index', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::post('update', 'update')->name('update');
                Route::delete('{id}/delete', 'destroy')->name('delete');
                Route::post('delete-selected', 'destroySelected')->name('destroy.selected');
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
                Route::get('index', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::post('update', 'update')->name('update');
                Route::delete('{id}/delete', 'destroy')->name('delete');
                Route::post('delete-selected', 'destroySelected')->name('destroy.selected');
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
                Route::get('index', 'index')->name('index');
                Route::post('store', 'store')->name('store');
                Route::post('update', 'update')->name('update');
                Route::delete('{id}/delete', 'destroy')->name('destroy');
                Route::post('delete-selected', 'destroySelected')->name('destroy.selected');
            });
    });



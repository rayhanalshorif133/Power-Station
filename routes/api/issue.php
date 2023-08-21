<?php

use App\Http\Controllers\Api\IssueController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')
    ->name('issue.')
    ->controller(IssueController::class)
    ->group(function () {
        Route::get('/issues/{id?}', 'fetchIssue')->name('fetch-Issue');
        Route::post('/issue-create', 'store')->name('store');
        Route::delete('/issue/{id}/delete', 'issueDestroy')->name('issue-destroy');
        Route::get('/issue/fetch-status/{id?}', 'fetchIssueStatus')->name('fetch-issue-status');

        // logs
        Route::get('/issue-logs/{id?}', 'fetchIssueLogs')->name('fetch-issue-logs');


        // Add device to issue
        Route::post('issue/{id}/add-device', 'addDevice')->name('add-device');
        // Route::post('issue/update-device', 'updateDevice')->name('update-device');
        Route::post('issue/{id}/delete-device', 'deleteDevice')->name('delete-device');

        // forwarded issue
        Route::post('issue/forwarded-issue', 'forwardedIssue')->name('forwarded-issue');
        Route::get('issue/{id}/{status}/forwarded-status-update', 'forwardedStatusUpdate')->name('forwarded-status-update');

        // // collaboration issue
        Route::post('issue/collaboration-issue', 'collaborationIssue')->name('collaboration-issue');
        Route::get('issue/{id}/{status}/collaboration-status-update', 'collaborationStatusUpdate')->name('collaborationStatusUpdate');


        // Work permits
        Route::post('issue/{id}/added-note-work-permits', 'addNoteWorkPermit')->name('addNoteWorkPermit');
        Route::get('issue/{id}/{status}/work-permit-status-update', 'workPermitStatusUpdate')->name('workPermitStatusUpdate');
    });

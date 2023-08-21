<?php

use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueHistoryLogController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')
    ->name('issue.')
    ->prefix('issue/')
    ->controller(IssueController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('update', 'update')->name('update');
        Route::get('/{id}/show', 'show')->name('show');
        Route::get('/{issueId}/profile-show', 'profileShow')->name('profile-show');
        Route::get('/{id}/fetch', 'fetch')->name('fetch');
        Route::post('action-update', 'actionUpdate')->name('actionUpdate');
        Route::get('{id}/fetch-not-issue-Department', 'fetchIssueDepartment')->name('fetchIssueDepartment');
        Route::get('{id}/fetch-issue-Department', 'fetchIssueInDepartment')->name('fetchIssueDepartment');
        Route::delete('{id}/delete', 'delete')->name('delete');
        Route::post('multi-delete', 'multiDelete')->name('multiDelete');


        // Issue Logs
        Route::get('logs', 'logs')->name('logs');
        
        // Add device to issue
        Route::post('/{id}/add-device', 'addDevice')->name('addDevice');
        Route::post('/edit-device', 'editDevice')->name('editDevice');
        Route::delete('/{id}/delete-device', 'deleteDevice')->name('deleteDevice');

        // forwarded issue
        Route::get('/forwarded-list', 'forwardedListIndex')->name('forwardedList.index');
        Route::post('/forwarded-issue', 'forwardedIssue')->name('forwardedIssue');
        Route::get('/{id}/{status}/forwarded-status-update', 'forwardedStatusUpdate')->name('forwardedStatusUpdate');

        // collaboration issue
        Route::get('/collaboration-list', 'collaborationIndex')->name('collaboration.index');
        Route::post('/collaboration-issue', 'collaborationIssue')->name('collaborationIssue');
        Route::get('/{id}/{status}/collaboration-status-update', 'collaborationStatusUpdate')->name('collaborationStatusUpdate');

        // Work permits
        Route::post('{id}/added-note-work-permits', 'addNoteWorkPermit')->name('addNoteWorkPermit');
        Route::get('/{id}/{status}/work-permit-status-update', 'workPermitStatusUpdate')->name('workPermitStatusUpdate');
    });

Route::middleware('auth')
    ->name('issue.')
    ->prefix('issue/')
    ->controller(IssueHistoryLogController::class)
    ->group(function () {
        Route::post('logs/multiple/delete', 'multiDeleteIssueLogs')->name('multi-delete-issue-logs');
    });

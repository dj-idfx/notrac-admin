<?php

use App\Http\Controllers\Cms\CmsAdminController;
use App\Http\Controllers\Cms\CmsDashboardController;
use App\Http\Controllers\Cms\CmsUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all backend CMS routes for the application.
|
*/

Route::prefix('cms')->name('cms.')->group(function () {

    /**
     * Dashboard controller
     */
    Route::get('/', [CmsDashboardController::class, 'index'])->name('dashboard.index');

    /**
     * User controller
     */
    Route::get('/users/trash', [CmsUserController::class, 'trash'])->name('users.trash');
    Route::delete('/users/trash/empty', [CmsUserController::class, 'empty'])->name('users.trash.empty');
    Route::patch('/users/{user}/restore', [CmsUserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{user}/delete', [CmsUserController::class, 'delete'])->name('users.delete');
    Route::patch('/users/{user}/activate', [CmsUserController::class, 'activate'])->name('users.activate');
    Route::patch('/users/{user}/hash', [CmsUserController::class, 'hash'])->name('users.hash');
    Route::resource('users', CmsUserController::class);

    /**
     * Admin secured area
     */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [CmsAdminController::class, 'index'])->name('index');
    });
});

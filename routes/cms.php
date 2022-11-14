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
    Route::get('/', [CmsDashboardController::class, 'index'])->name('index');

    /**
     * User controller
     */
    Route::resource('users', CmsUserController::class);

    /**
     * Admin secured area
     */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [CmsAdminController::class, 'index'])->name('index');
    });
});

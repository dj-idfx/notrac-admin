<?php

use App\Http\Controllers\Cms\CmsAdminController;
use App\Http\Controllers\Cms\CmsDashboardController;
use App\Http\Controllers\Cms\CmsMediaController;
use App\Http\Controllers\Cms\CmsPostController;
use App\Http\Controllers\Cms\CmsRoleController;
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
    Route::patch('/users/{user}/unhash', [CmsUserController::class, 'unhash'])->name('users.unhash');
    Route::get('/users/hashed', [CmsUserController::class, 'hashed'])->name('users.hashed');
    Route::resource('users', CmsUserController::class);

    /**
     * Role controller
     */
    Route::resource('roles', CmsRoleController::class);

    /**
     * Post controller
     */
    Route::get('/posts/trash', [CmsPostController::class, 'trash'])->name('posts.trash');
    Route::delete('/posts/trash/empty', [CmsPostController::class, 'empty'])->name('posts.trash.empty');
    Route::patch('/posts/{post}/restore', [CmsPostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{post}/delete', [CmsPostController::class, 'delete'])->name('posts.delete');
    Route::patch('/posts/{post}/publish', [CmsPostController::class, 'publish'])->name('posts.publish');
    Route::post('/posts/{post}/images', [CmsPostController::class, 'images'])->name('posts.images');
    Route::resource('posts', CmsPostController::class);

    /**
     * Media controller
     */
    Route::resource('media', CmsMediaController::class);

    /**
     * Admin secured area
     */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [CmsAdminController::class, 'index'])->name('index');
        Route::get('/queue/media', [CmsAdminController::class, 'queueMedia'])->name('queue_media');
    });
});

<?php

use App\Http\Controllers\Cms\CmsDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all backend CMS routes for the application.
|
*/

Route::middleware(['auth', 'verified', 'can:access cms'])
    ->prefix('cms')
    ->name('cms.')
    ->group(function () {

        /* Index dashboard page */
        Route::get('/', [CmsDashboardController::class, 'index'])->name('index');

    });

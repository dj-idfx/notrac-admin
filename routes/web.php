<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Main web routes
 */
Route::get('/', HomeController::class)->name('home');


/**
 * User account routes
 */
Route::permanentRedirect('/account', '/account/dashboard');
Route::controller(AccountController::class)
    ->prefix('account')
    ->name('account.')
    ->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');
    });


/**
 * Authentication routes
 */
require __DIR__.'/auth.php';


/**
 * CMS admin routes
 */
// TODO


/**
 * Fallback route (redirect 404's)
 * This fallback route should always be the last route registered!
 */
Route::fallback(FallbackController::class);

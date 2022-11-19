<?php

use App\Http\Controllers\Account\AccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User account Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all routes made available to logged-in users.
|
*/

Route::prefix('account')->name('account.')->group(function () {

    Route::permanentRedirect('/', '/account/dashboard');

    /**
     * Account Controller
     */
    Route::controller(AccountController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');

        // Route for redirect inactive users
        Route::get('/inactive', 'inactive')->name('inactive');
    });
});

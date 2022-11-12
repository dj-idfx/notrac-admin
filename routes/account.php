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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::permanentRedirect('/account', '/account/dashboard');

    /**
     * Account Controller
     */
    Route::controller(AccountController::class)
        ->prefix('account')
        ->name('account.')
        ->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
        });

});

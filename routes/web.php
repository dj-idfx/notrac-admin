<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
 * Public web routes
 */
/* Homepage */
Route::get('/', HomeController::class)->name('home');

/* Posts */
Route::resource('posts', PostController::class)->only('index', 'show');


/**
 * User authentication routes
 */
require __DIR__.'/auth.php';

/**
 * User account routes
 */
require __DIR__.'/account.php';

/**
 * CMS admin routes
 */
require __DIR__.'/cms.php';

/**
 * Fallback route (redirect 404's)
 * This fallback route should always be the last route registered!
 */
Route::fallback(FallbackController::class);

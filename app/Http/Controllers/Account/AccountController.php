<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Instantiate the controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Base middleware for all account routes
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display the user account dashboard.
     *
     * @return View
     */
    public function dashboard(): View
    {
        return view('account.dashboard');
    }

    /**
     * Display the user profile.
     *
     * @return View
     */
    public function profile(): View
    {
        return view('account.profile');
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        // Middleware for all account routes
        $this->middleware(['auth', 'verified']);
        $this->middleware(['active'])->except('inactive');
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

    /**
     * User inactive view.
     *
     * @return RedirectResponse|View
     */
    public function inactive(): RedirectResponse|View
    {
        if (Auth::user()->active) {
            return redirect()->route('account.dashboard');
        }
        return view('account.inactive');
    }

}

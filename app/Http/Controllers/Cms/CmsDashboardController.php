<?php

namespace App\Http\Controllers\Cms;

use App\Models\User;
use Illuminate\View\View;

class CmsDashboardController extends BaseCmsController
{
    /**
     * Instantiate the controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Import BaseCmsController constructor with the basic CMS routes middleware
        parent::__construct();
    }

    /**
     * Display the CMS dashboard view.
     *
     * @return View
     */
    public function index(): View
    {
        $userCount = User::count();
        $userUnverifiedCount = User::whereNull('email_verified_at')->count();
        $userInactiveCount = User::where('active', false)->count();
        return view('cms.index', compact('userCount', 'userUnverifiedCount', 'userInactiveCount'));
    }
}

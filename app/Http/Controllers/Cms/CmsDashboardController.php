<?php

namespace App\Http\Controllers\Cms;

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
        return view('cms.index');
    }
}

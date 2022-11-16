<?php

namespace App\Http\Controllers\Cms;

use Illuminate\View\View;

class CmsAdminController extends BaseCmsController
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
        // Add extra 'admin acces' middleware
        $this->middleware(['can:access admin']);
    }

    /**
     * Display the CMS admin index view.
     *
     * @return View
     */
    public function index(): View
    {
        return view('cms.admin.index');
    }
}

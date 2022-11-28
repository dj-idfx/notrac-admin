<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\RedirectResponse;
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
        // Start media queue
        $this->middleware(['queue_media'])->only(['queue']);
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

    /**
     * Start the media queue worker.
     *
     * @return RedirectResponse
     */
    public function queueMedia(): RedirectResponse
    {
        session()->flash('flash_message', __('Media queue started!'));
        session()->flash('flash_level', 'success');

        return redirect()->route('cms.admin.index');
    }
}

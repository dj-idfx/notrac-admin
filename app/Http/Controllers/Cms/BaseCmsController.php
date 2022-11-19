<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;

class BaseCmsController extends Controller
{
    /**
     * Instantiate the controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Base middleware for all CMS routes
        $this->middleware(['auth', 'verified', 'active', 'can:access cms']);
    }
}

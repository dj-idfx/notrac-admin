<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view that represents the layout.
     *
     * @return View
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}

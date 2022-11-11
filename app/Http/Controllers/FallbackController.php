<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FallbackController extends Controller
{
    /**
     * Display the fallback 404 view.
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('fallback.index');
    }
}

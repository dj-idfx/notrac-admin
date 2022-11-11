<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display Homepage.
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('home');
    }
}

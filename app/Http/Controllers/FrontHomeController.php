<?php

namespace App\Http\Controllers;

use Illuminate\contracts\View\View;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('frontend.home');
    }
}

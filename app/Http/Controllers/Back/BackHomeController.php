<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class BackHomeController extends Controller
{
    public function __invoke(): View
    {
        return view('backend.home');
    }
}

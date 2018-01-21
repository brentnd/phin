<?php

namespace Site;

use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
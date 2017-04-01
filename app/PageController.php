<?php

namespace App;

use Phine\Controller;

class PageController extends Controller
{
    public function home()
    {
        $test = "Wow";
        return view('pages.home', compact('test'));
    }
}
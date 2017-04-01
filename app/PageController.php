<?php

namespace App;

use Phine\Controller;

class PageController extends Controller
{
    public function home()
    {
        $test = "Wow";
        return $this->view('pages.home', compact('test'));
    }
}
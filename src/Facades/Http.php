<?php

namespace Phin\Facades;

use Illuminate\Support\Facades\Facade;

class Http extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'http';
    }
}

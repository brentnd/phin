<?php

namespace Phine;

use Illuminate\Support\Facades\Facade;

class FakerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'faker';
    }
}

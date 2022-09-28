<?php

namespace App\Classes\Support;

use Illuminate\Support\Facades\Facade;

class StorieSupportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'storie-support';
    }
}

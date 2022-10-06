<?php

namespace App\Classes\Support;

use Illuminate\Support\Facades\Facade;

class StorieSupportFacade extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'storie-support';
    }
}

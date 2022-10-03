<?php

namespace App\Classes\Data;

use Illuminate\Support\Facades\Facade;

class DataFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'data';
    }
}
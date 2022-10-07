<?php

namespace App\Classes\Data;

use Illuminate\Support\Facades\Facade;

class StorieDataFacade extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'storie-data';
    }
}
<?php

namespace App\Classes\Data;

use Illuminate\Support\Facades\Facade;

class UserDataFacade extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'user-data';
    }
}
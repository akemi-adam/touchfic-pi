<?php

namespace App\Classes\Data;

use Illuminate\Support\Facades\Facade;

class UserDataFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'user-data';
    }
}
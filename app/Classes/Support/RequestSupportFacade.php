<?php

namespace App\Classes\Support;

use Illuminate\Support\Facades\Facade;

class RequestSupportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'request-support';
    }
}
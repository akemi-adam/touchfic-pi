<?php

namespace App\Classes\Messages;

use Illuminate\Support\Facades\Facade;

class LoggerFacade extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'logger';
    }
}
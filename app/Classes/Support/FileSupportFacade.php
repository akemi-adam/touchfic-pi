<?php

namespace App\Classes\Support;

use Illuminate\Support\Facades\Facade;

class FileSupportFacade extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'file-support';
    }
}
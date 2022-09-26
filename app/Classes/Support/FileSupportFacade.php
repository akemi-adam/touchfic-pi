<?php

namespace App\Classes\Support;

use Illuminate\Support\Facades\Facade;

class FileSupportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'file-support';
    }
}
<?php

namespace App\Classes\Data;

use Illuminate\Support\Facades\Facade;

class ChapterDataFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'chapter-data';
    }
}
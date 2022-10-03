<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Data\Data;

class DataProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('data', function ()
        {
            return new Data;
        });
    }


    public function boot()
    {
        //
    }
}

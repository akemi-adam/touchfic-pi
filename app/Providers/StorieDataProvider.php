<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Data\StorieData;

class StorieDataProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('storie-data', function ()
        {
            return new StorieData;
        });        
    }

    public function boot()
    {
        //
    }
}

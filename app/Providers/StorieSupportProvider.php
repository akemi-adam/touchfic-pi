<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Support\StorieSupport;

class StorieSupportProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('storie-support', function ()
        {
            return new StorieSupport;
        });
    }

    public function boot()
    {
        //
    }
}

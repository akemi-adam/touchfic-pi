<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Messages\Logger;

class LoggerProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('logger', function ()
        {
            return new Logger;
        });
    }

    public function boot()
    {
        //
    }
}

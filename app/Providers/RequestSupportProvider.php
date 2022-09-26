<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Support\RequestSupport;

class RequestSupportProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('request-support', function ()
        {
            return new RequestSupport;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

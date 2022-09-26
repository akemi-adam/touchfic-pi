<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Support\FileSupport;

class FileSupportProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('file-support', function ()
        {
            return new FileSupport;
        });
    }

    public function boot()
    {
        //
    }
    
}

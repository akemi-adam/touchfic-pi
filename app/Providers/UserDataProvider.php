<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Data\UserData;

class UserDataProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('user-data', function ()
        {
            return new UserData;
        });
    }

    public function boot()
    {
        //
    }
}

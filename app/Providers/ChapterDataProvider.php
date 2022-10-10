<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Data\ChapterData;

class ChapterDataProvider extends ServiceProvider
{
    public function register()
    {
        return $this->app->bind('chapter-data', function () {
            return new ChapterData;
        });
    }

    public function boot()
    {
        //
    }
}

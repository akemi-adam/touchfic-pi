<?php

namespace App\Listeners;

use App\Events\StorieLike;
use App\Notifications\StorieLikeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class SendStorieLikeNotification
{
    public function __construct()
    {
        //
    }

    public function handle(StorieLike $event)
    {
        $storie = $event->storie;
        $author = $event->author;

        $author->notify(new StorieLikeNotification($event->reader, $storie));
    }
}

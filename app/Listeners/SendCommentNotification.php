<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use App\Notifications\CommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentEvent  $event
     * @return void
     */
    public function handle(CommentEvent $event)
    {
        $owner = $event->owner;

        $owner->notifY(new CommentNotification($event->author, $event->publication));
    }
}

<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use App\Notifications\CommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
{
    /**
     * Sends the notification of a chapter comment to the owner of the story
     *
     * @param  \App\Events\CommentEvent  $event
     * @return void
     */
    public function handle(CommentEvent $event)
    {
        $owner = $event->owner;

        $owner->notify(new CommentNotification($event->author, $event->publication));
    }
}

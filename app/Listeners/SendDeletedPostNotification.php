<?php

namespace App\Listeners;

use App\Events\DeletePublication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostDeletedNotification;
use App\Models\{
    Post, User
};

class SendDeletedPostNotification
{
    /**
     * Handle the event.
     *
     * @param DeletePublication $event
     * @return void
     */
    public function handle(DeletePublication $event)
    {
        $post = $event->publication;

        $post->user->notify(
            new PostDeletedNotification($post)
        );
    }
}

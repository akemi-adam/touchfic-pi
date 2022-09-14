<?php

namespace App\Listeners;

use App\Events\DeleteStorie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveCommentChapterNotification
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
     * @param  \App\Events\DeleteStorie  $event
     * @return void
     */
    public function handle(DeleteStorie $event)
    {
        //
    }
}

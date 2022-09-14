<?php

namespace App\Listeners;

use App\Events\DeletePublication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Arr;

class DeleteCommentPublicationNotification
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
     * @param  \App\Events\DeletePublication  $event
     * @return void
     */
    public function handle(DeletePublication $event)
    {
        $publication = $event->publication;

        DB::table('notifications')->whereJsonContains('data', [
            'post' => [
                'id' => $publication->id
            ]
        ])->delete();

        DB::table('notifications')->whereJsonContains('data', [
            'chapter' => [
                'id' => $publication->id
            ]
        ])->delete();

    }
}

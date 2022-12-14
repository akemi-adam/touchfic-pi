<?php

namespace App\Listeners;

use App\Events\Unlike;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class RemoveLikeNotification
{
    /**
     * Deletes the notification when un-linking
     *
     * @param  \App\Events\Unlike  $event
     * @return void
     */
    public function handle(Unlike $event)
    {
        $publication = $event->publication;

        DB::table('notifications')
            ->where('type', 'App\Notifications\StorieLikeNotification')
            ->whereJsonContains('data', [
                'storie_id' => $publication->id
            ])->delete();

    }
}

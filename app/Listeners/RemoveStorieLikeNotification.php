<?php

namespace App\Listeners;

use App\Events\DeleteStorie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class RemoveStorieLikeNotification
{
    /**
     * Removes the like notification when the story is deleted
     *
     * @param  \App\Events\DeleteStorie  $event
     * @return void
     */
    public function handle(DeleteStorie $event)
    {
        $storie = $event->storie;

        DB::table('notifications')
        ->where('type', 'App\Notifications\StorieLikeNotification')
        ->whereJsonContains('data', [
            'storie_id' => $storie->id
        ])
        ->delete();
    }
}

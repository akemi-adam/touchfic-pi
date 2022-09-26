<?php

namespace App\Listeners;

use App\Events\UpdateStorie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateStorieNotification
{
    /**
     * Updates all notifications for a particular story when it is updated
     *
     * @param  \App\Events\UpdateStorie  $event
     * @return void
     */
    public function handle(UpdateStorie $event)
    {
        $storie = $event->storie;

        DB::table('notifications')
            ->where('type', 'App\Notifications\StorieLikeNotification')
            ->whereJsonContains('data', [
                'storie_id' => $storie->id
            ])->update([
                'data->storie_title' => $storie->title
            ]);
        
        DB::table('notifications')
            ->where('type', 'App\Notifications\CommentNotification')
            ->whereJsonContains('data', [
                'storie' => [
                    'id' => $storie->id
                ]
            ])->update([
                'data->storie' => [
                    'title' => $storie->title
                ]
            ]);

    }
}

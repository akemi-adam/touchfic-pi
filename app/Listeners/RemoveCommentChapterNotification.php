<?php

namespace App\Listeners;

use App\Events\DeleteStorie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class RemoveCommentChapterNotification
{
    /**
     * Deletes all notifications from the chapters of the specific story
     *
     * @param  \App\Events\DeleteStorie  $event
     * @return void
     */
    public function handle(DeleteStorie $event)
    {
        $storie = $event->storie;

        DB::table('notifications')
        ->where('type', 'App\Notifications\CommentNotification')
        ->whereJsonContains('data', [
            'storie' => [
                'id' => $storie->id
            ]
        ])
        ->delete();
    }
}

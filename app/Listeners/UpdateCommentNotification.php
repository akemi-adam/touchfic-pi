<?php

namespace App\Listeners;

use App\Events\UpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Arr;

class UpdateCommentNotification
{
    /**
     * Updates the comment notification data when the user changes some personal data, such as name
     *
     * @param  \App\Events\UpdateNotification  $event
     * @return void
     */
    public function handle(UpdateNotification $event)
    {

        $notifications = DB::table('notifications')->where('type', 'App\Notifications\CommentNotification')->get();

        if (count($notifications) !== 0) {

            $user = $event->user;

            foreach ($notifications as $notification) {

                DB::table('notifications')->whereJsonContains('data', [
                    'author' => [
                        'id' => $user->id,
                    ]
                ])->update([
                    'data->author' => [
                        'name' => $user->name,
                        'avatar' => $user->avatar,
                        'id' => $user->id
                    ]
                ]);
            }
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\UpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;


class UpdateLikeNotification
{
    /**
     * Updates the liking notification data when the user changes some personal data, such as name
     *
     * @param  \App\Events\UpdateNotification  $event
     * @return void
     */
    public function handle(UpdateNotification $event)
    {
        $notificationsNumber = count(DB::table('notifications')->where('type', 'App\Notifications\StorieLikeNotification')->get());
        
        if ($notificationsNumber !== 0) {

            $user = $event->user;

            DB::table('notifications')->whereJsonContains('data', [
                'reader_id' => $user->id
            ])->update([
                'data->reader_name' => $user->name,
                'data->reader_avatar' => $user->avatar
            ]);

        }
    }
}

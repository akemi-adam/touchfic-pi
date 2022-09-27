<?php

namespace App\Listeners;

use App\Events\DeleteStorie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DB;

class UnwrapStorie
{
    /**
     * Takes out all the links that the story has to other tables in the bank
     *
     * @param  \App\Events\DeleteStorie  $event
     * 
     * @return void
     */
    public function handle(DeleteStorie $event)
    {
        $storie = $event->storie;

        $storie->users()->detach();

        $storie->genres()->detach();

        DB::table('likes')->where('storie_id', $storie->id)->delete();
    }
}

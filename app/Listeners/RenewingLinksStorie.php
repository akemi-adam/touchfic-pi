<?php

namespace App\Listeners;

use App\Events\UpdateStorie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RenewingLinksStorie
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UpdateStorie  $event
     * @return void
     */
    public function handle(UpdateStorie $event)
    {
        $storie = $event->storie;

        $request = $event->request;

        $storie->genres()->detach();

        foreach ($request->genres as $genre) {
            $storie->genres()->attach($genre);
        }
    }
}

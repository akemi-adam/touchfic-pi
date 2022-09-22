<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Unlike
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var App\Models\Chapter|App\Models\Post $publication publication */
    public $publication;

    /**
     * Set the publication
     *
     * @param App\Models\Chapter|App\Models\Post $publication 
     **/
    public function __construct($publication)
    {
        $this->publication = $publication;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

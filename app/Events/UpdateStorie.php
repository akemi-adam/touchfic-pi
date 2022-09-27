<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Storie;

class UpdateStorie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Storie $storie */
    public $storie;

    /** @var $request */
    public $request;

    /**
     * Set the story 
     *
     * @param Storie $storie the story itself
     **/
    public function __construct(Storie $storie, $request = null)
    {
        if (!is_null($request)) {
            $this->request = $request;
        }

        $this->storie = $storie;
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

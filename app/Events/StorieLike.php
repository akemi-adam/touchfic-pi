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
use App\Models\User;

class StorieLike
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reader;

    public $storie;

    public $author;

    public function __construct(User $reader, Storie $storie, User $author)
    {
        $this->reader = $reader;
        $this->storie = $storie;
        $this->author = $author;
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

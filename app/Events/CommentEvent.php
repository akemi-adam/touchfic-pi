<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class CommentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $owner publication owner */
    public $owner;

    /** @var User $author comment author */
    public $author;

    /** @var App\Models\Chapter|App\Models\Post $publication comment publication */
    public $publication;

    /**
     * Sets attribute values
     *
     * @param User $owner publication owner
     * @param User $author comment author
     * @param App\Models\Chapter|App\Models\Post $publication comment publication
     **/
    public function __construct(User $owner, User $author, $publication)
    {
        $this->owner = $owner;
        $this->author = $author;
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

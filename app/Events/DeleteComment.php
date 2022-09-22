<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteComment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var App\Models\Commentchapter|App\Models\Commentpost $comment publication comment */
    public $comment;
    
    /**
     * Set the comment
     *
     * @param App\Models\Commentchapter|App\Models\Commentpost $comment publication comment
     **/
    public function __construct($comment)
    {
        $this->comment = $comment;
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

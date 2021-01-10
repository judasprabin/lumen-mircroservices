<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OwnerCreatedEvent extends Event implements ShouldBroadcast
{

    use SerializesModels;

    public $owner;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($owner)
    {
        $this->owner = $owner;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('owner-channel');
    }

}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class newAcceptRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $destinationUserId ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($destinationUserId)
    {
        $this->destinationUserId = $destinationUserId ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-accept-channel');
    }
}

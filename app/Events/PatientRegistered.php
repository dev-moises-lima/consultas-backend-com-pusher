<?php

namespace App\Events;

use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PatientRegistered implements ShouldBroadcast
{
    use Dispatchable, SerializesModels, InteractsWithSockets;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public PatientResource $patient
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('main-updates');
    }
}

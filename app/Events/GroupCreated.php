<?php

namespace App\Events;

use App\Models\Group;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $group;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('group.' . $this->group->name);
    }
    public function broadcastAs()
    {
        return "group";
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->group->id,
            'user' => $this->group->users,
            'group' => $this->group->name
        ];
    }
}

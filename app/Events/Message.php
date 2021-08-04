<?php

namespace App\Events;

use App\Models\Group;
use App\Models\Message as ModelsMessage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public function __construct(ModelsMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('group.' . $this->message->group_id);
    }
    public function broadcastAs()
    {
        return "message";
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'users' =>$this->message->user,
            'group' =>$this->message->group
        ];
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;

    // Конструктор теперь принимает только 2 параметра
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }

    // Добавляем метод для данных трансляции
    public function broadcastWith()
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'message' => $this->message
        ];
    }
}

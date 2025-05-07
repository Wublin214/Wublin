<?php

namespace App\Http\Resources\Message;

use App\Models\Master;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'message' => $this->message,
            'client_id' => $this->client_id,
            'master' => $this->whenLoaded('master', fn() => [
                'id' => $this->master->id,
                'firstName' => $this->master->firstName . ' ' . $this->master->lastName,
            ]),
            'chat_id' => $this->chat_id,
            'user_type' => $this->user_type,
            'created_at' => $this->created_at->diffForHumans(),
        ];

    }
}

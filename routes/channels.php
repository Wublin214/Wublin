<?php

use App\Models\Client;
use App\Models\Master;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    // Убедитесь, что используется правильный guard
    return $user instanceof Client || $user instanceof Master;
});

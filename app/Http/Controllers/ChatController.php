<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Client;
use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ChatController extends Controller
{

    public function route()
    {
        return Inertia::render('Chat/Index');
    }


}

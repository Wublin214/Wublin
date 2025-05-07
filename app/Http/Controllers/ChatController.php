<?php

namespace App\Http\Controllers;
use App\Http\Requests\Message\StoreMessage;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Models\chats;
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
        $client_id = Auth::id();

        // Получаем сообщения с информацией о мастере
        $messagesWithMaster = Message::join('masters', 'messages.master_id', '=', 'masters.id')
            ->where('messages.client_id', $client_id)
            ->select('messages.*', 'masters.firstName as master_name')
            ->orderBy('messages.created_at')
            ->get();

        // Получаем список чатов (сообщений)
        $listChat = Chat::join('masters', 'chats.master_id', '=', 'masters.id')
            ->where('chats.client_id', $client_id)
            ->select('chats.*', 'masters.firstName as MasterFirstName')
            ->orderBy('chats.created_at')
            ->get();

        return Inertia::render('Chat/Index', [
            'Message' => $messagesWithMaster,
            'ListChat' => $listChat,
            'Client_id' => $client_id,
        ]);
    }

    public function StoryChat(Request $request){
        $master_id = $request->master_id;
        $client_id = Auth::id();

        $CheckChat = Chat::where('client_id', $client_id)
            ->where('master_id', $master_id)
            ->first();
        if ($CheckChat){

            return redirect()->route('ClientChat')->with('info', 'Чат уже существует!');;
        }else{
            Chat::create([

                'client_id'=>$client_id,
                'master_id'=>$master_id
            ]);

            return redirect()->route('ClientChat');

        }
    }

    public function StoryMessage(Request $request){
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'chat_id' => 'required|integer|exists:chats,id',
            'user_type' => 'required|in:client,master',
            'client_id' => 'nullable|integer|exists:clients,id',
            'master_id' => 'nullable|integer|exists:masters,id'
        ]);

        // Создаем сообщение
        $message = Message::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }
}

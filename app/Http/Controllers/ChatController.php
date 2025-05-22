<?php

namespace App\Http\Controllers;
use App\Events\StoryMassageEvent;
use App\Events\StoryMessageEvent;
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

        if (Auth::guard('clients')->check()){

            $client_id = Auth::id();
            $Auth = 'client';

            // Получаем список чатов (сообщений)
            $listChat = Chat::join('masters', 'chats.master_id', '=', 'masters.id')
                ->where('chats.client_id', $client_id)
                ->select('chats.*', 'masters.firstName as MasterFirstName')
                ->orderBy('chats.created_at')
                ->get();

            return Inertia::render('Chat/Index', [
                'ListChat' => $listChat,
                'Client_id' => $client_id,
                'Auth' => $Auth,
            ]);


        }else if (Auth::guard('masters')->check()){

            $master_id = Auth::id();
            $Auth = 'master';

            // Получаем список чатов (сообщений)
            $listChat = Chat::join('clients', 'chats.client_id', '=', 'clients.id')
                ->where('chats.master_id', $master_id)
                ->select('chats.*', 'clients.firstName as ClientFirstName')
                ->orderBy('chats.created_at')
                ->get();

            return Inertia::render('Chat/Index', [
                'ListChat' => $listChat,
                'Master_id' => $master_id,
                'Auth' => $Auth,
            ]);

        }



    }
    public function getMessageChat(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|integer|exists:chats,id',
            'master_id' => 'required|integer|exists:masters,id',
            'client_id' => 'required|integer|exists:clients,id'
        ]);

        $messages = Message::with('master')
            ->where('chat_id', $validated['chat_id'])
            ->where('master_id', $validated['master_id'])
            ->where('client_id', $validated['client_id'])
            ->orderBy('created_at')
            ->get();

        // Получаем имя мастера отдельно
        $masterName = Master::find($validated['master_id'])->firstName ?? 'Master';

        return response()->json([
            'messages' => $messages->map(function ($message) use ($masterName) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'user_type' => $message->user_type,
                    'created_at' => $message->created_at,
                    'master_name' => $message->user_type === 'client' ? 'Вы' : $masterName
                ];
            }),
            'master_name' => $masterName
        ]);
    }

    public function StoryChat(Request $request){
        $master_id = $request->master_id;
        $client_id = Auth::id();

        $CheckChat = Chat::where('client_id', $client_id)
            ->where('master_id', $master_id)
            ->first();
        if ($CheckChat){

            return redirect()->route('ClientChat')->with('info', 'Чат уже существует!');
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
        event(new StoryMessageEvent($message));

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }
}

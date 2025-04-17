<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientCardController extends Controller
{
    public function ClientView(Request $request)
    {
// принимает значение id (js) и из бд (Client) ищет клиента с таким id
        $data = Client::where('id', $request->input('id'))->get();
//Передает значение в массиве data
        return view('Client.ClientCard', ['data' => $data]);
    }
}

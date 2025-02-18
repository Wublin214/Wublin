<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class FrelanserCardController extends Controller
{
    public function ClientView(Request $request)
    {

        $data = Client::where('id', $request->input('id'))->get();

        return view('card', ['data' => $data]);
    }
}

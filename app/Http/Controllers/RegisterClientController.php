<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterClientController extends Controller
{
    public function router(){
        return view('RegisterClient');
    }

    public function store(Request $request){

        $duplicate_Clients = DB::table('clients')
            ->where('Email',  $request->ClientEmail)
            ->first();

        if($duplicate_Clients) {
            return response('Пользователь с таким Email уже сущевствует ', 422);
        }else{ $NewClient = Client::create([
            "FirstName" => $request->ClientFirstName,
            "LastName" => $request->ClientLastName,
            "Email" => $request->ClientEmail,
            "Password" => $request->ClientPassword,
            "Gender" => $request->ClientGender,
        ]);

            Auth::guard('web')->login($NewClient);

            return redirect('/MainClient');
        }
    }
}

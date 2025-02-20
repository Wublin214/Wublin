<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterClientController extends Controller
{
    public function router(){
        return view('RegisterClient');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,Email',
            'password' => 'required|string|min:8',
            'gender' => 'required|string',
        ]);

        // Create the new client
        $NewClient = Client::create([
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "email" => $request->email,
            "password" => Hash::make($request->password), // Hash the password
            "gender" => $request->gender,
        ]);


        Auth::login($NewClient);


        event(new Registered($NewClient));


        return redirect()->route("verification.notice");
    }
}

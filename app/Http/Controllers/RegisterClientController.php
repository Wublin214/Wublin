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
        try {
            // Validate the request
            $request->validate([
                'FirstName' => 'required|string|max:255',
                'LastName' => 'required|string|max:255',
                'Email' => 'required|email|unique:clients,Email',
                'Password' => 'required|string|min:8',
                'Gender' => 'required|string',
            ]);

            // Debug: Check if validation passed
            logger('Validation passed.');

            // Create the new client
            $NewClient = Client::create([
                "FirstName" => $request->FirstName,
                "LastName" => $request->LastName,
                "Email" => $request->Email,
                "Password" => Hash::make($request->Password), // Hash the password
                "Gender" => $request->Gender,
            ]);

            // Debug: Check if client creation succeeded
            logger('Client created: ' . $NewClient->id);

            // Log in the new client
            Auth::login($NewClient);

            // Debug: Check if login succeeded
            logger('Client logged in.');

            // Trigger the Registered event
            event(new Registered($NewClient));

            // Debug: Check if event was triggered
            logger('Registered event triggered.');

            // Redirect to the email verification notice
            return redirect()->route("verification.notice");
        } catch (\Exception $e) {
            logger('Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

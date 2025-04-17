<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Rules\NoBadWords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class RegisterClientController extends Controller
{
    public function router(){
        return view('Client.RegisterClient');
    }

    public function store(Request $request)
    {
// валидация данных
    $request->validate([
        //NoBadWords - запрещенные слова
        'firstName' => ['required', 'string', 'max:255', new NoBadWords],
        'lastName' => ['required', 'string', 'max:255', new NoBadWords],
        'email' => 'required|email|unique:clients,email',
        'password' => 'required|string|min:8',
        'gender' => 'required|string',
    ]);

    // записываються данные
    $NewClient = Client::create([
        "firstName" => $request->firstName,
        "lastName" => $request->lastName,
        "email" => $request->email,
        "password" => Hash::make($request->password),
        "gender" => $request->gender,
    ]);

    // Записываеться данные пользователя в бд
        // отправляеться сообщение на email
        if ($NewClient) {
            Auth::guard('clients')->login($NewClient);
            event(new Registered($NewClient));
            return redirect()->route('verification.notice');
        } else {

            return redirect('/register')->withErrors(['message' => 'Ошибка при создании клиента.']);
        }



    }
}

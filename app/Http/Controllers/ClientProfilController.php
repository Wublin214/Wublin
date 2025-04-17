<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfilController extends Controller
{
    public function router(){
//берет значение id у Авторизированого пользователя
        $idClient = Auth::id();


        if (!$idClient) {
            return redirect()->route('login');
        }
//ищет из бд клиента по id
        $date = Client::find($idClient);

        if (!$date) {
            return redirect()->route('error.page');
        }
//перекидывает на страницу профиля с массивом данных
        return view('Client.ClientProfil', ['date' => $date]);
    }
}

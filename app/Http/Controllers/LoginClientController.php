<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Session;

class LoginClientController extends Controller
{
    public function router(){
        return view('LoginClient');
    }

    public function login(Request $request)
    {
        // Валидация входящих данных
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Получение учетных данных
        $credentials = $request->only('email', 'password');

        // Проверка, существует ли пользователь с указанным email
        $Client = Client::where('email', $credentials['email'])->first();

        if (!$Client) {
            // Если пользователь не найден
            return back()->withErrors(['login' => 'Пользователь с таким email не найден']);
        }

        // Проверка пароля
        if (!Hash::check($credentials['password'], $Client->password)) {
            // Если пароль неверный
            return back()->withErrors(['login' => 'Неверный пароль']);
        }


        // Авторизация пользователя
        Auth::login($Client);

        // Регистрация новой сессии
        $request->session()->regenerate();

        // Перенаправление на целевую страницу
        return redirect()->route("MainClient");
    }
}

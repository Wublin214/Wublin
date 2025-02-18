<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Session;

class LoginClientController extends Controller
{
    public function router(){
        return view('LoginClient');
    }

    public function login(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Получение учетных данных
        $credentials = $request->only('email', 'password');

        // Поиск пользователя по email
        $Client = Client::where('email', $credentials['email'])->first();

        // Проверка пароля
        if ($Client && $Client->password === $credentials['password']) {
            // Регистрация новой сессии
            Auth::login($Client);
            $request->session()->regenerate();

            // Перенаправление на целевую страницу
            return redirect()->intended('/MainClient');
        }

        // Возврат с ошибкой, если аутентификация не удалась
        return back()->withErrors(['login' => 'Неверный логин или пароль']);
    }
}

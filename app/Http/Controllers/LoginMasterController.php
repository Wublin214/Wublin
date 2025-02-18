<?php
namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMasterController extends Controller
{
    public function router()
    {
        return view('LoginMaster');
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
        $master = Master::where('email', $credentials['email'])->first();

        // Проверка пароля
        if ($master && $master->password === $credentials['password']) {
            // Регистрация новой сессии
            Auth::guard('masters')->login($master);
            $request->session()->regenerate();

            // Проверка аутентификации

                return redirect('/MainMaster');

        }


        return back()->withErrors(['login' => 'Неверный логин или пароль']);
    }
}

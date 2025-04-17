<?php
namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginMasterController extends Controller
{
    public function router()
    {
        return view('Master.LoginMaster');
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

        if (!$master) {
            // Если пользователь не найден
            return back()->withErrors(['login' => 'Пользователь с таким email не найден']);
        }

        if (!Hash::check($credentials['password'], $master->password)) {
            // Если пароль неверный
            return back()->withErrors(['login' => 'Неверный пароль']);
        }else{

            Auth::guard('masters')->login($master);
            $request->session()->regenerate();

            return redirect('/MainMaster');
        }


    }
}

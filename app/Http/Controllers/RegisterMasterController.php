<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterMasterController extends Controller
{
    public function router()
    {
        return view('Master.RegisterMaster');
    }

    public function store(Request $request)
    {
        // поиск  мастера по такому email
        $duplicate_masters = DB::table('masters')
            ->where('Email', $request->MasterEmail)
            ->first();

        if ($duplicate_masters) {
            return response('Пользователь с таким Email уже существует', 422);
        } else {
            // записываеться данные в бд
            $NewMaster = Master::create([
                "firstName" => $request->MasterFirstName,
                "lastName" => $request->MasterLastName,
                "email" => $request->MasterEmail,
                "password" => Hash::make($request->MasterPassword), // Hash the password
                "gender" => $request->MasterGender,
            ]);


            Auth::guard('masters')->login($NewMaster);
            // отправляеться сообщение на email
            event(new Registered($NewMaster));

            return redirect()->route('verification.notice');
        }

    }
}

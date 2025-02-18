<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterMasterController extends Controller
{
    public function router()
    {
        return view('RegisterMaster');
    }

    public function store(Request $request)
    {

        $duplicate_masters = DB::table('masters')
            ->where('Email',  $request->MasterEmail)
            ->first();

        if ($duplicate_masters){
            return response('Пользователь с таким Email уже сущевствует', 422);
        }else{// Создание нового мастера
            $NewMaster = Master::create([
                "firstName" => $request->MasterFirstName,
                "lastName" => $request->MasterLastName,
                "email" => $request->MasterEmail,
                "password" => $request->MasterPassword,
                "gender" => $request->MasterGender,
            ]);

            // Аутентификация нового мастера
            Auth::guard('masters')->login($NewMaster);

            return redirect('/MainMaster');}



    }
}

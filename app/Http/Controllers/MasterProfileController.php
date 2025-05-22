<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterProfileController extends Controller
{
    public function router(){

       $Master_id =  Auth::id();
       $date = Master::find($Master_id);

        return view('Master.MasterProfil',['date'=>$date]);

    }


    public function MasterNewPortfolio(Request $request)
    {
        // Ваша логика здесь
    }

    public function MasterPostNewPortfolio(Request $request)
    {
        // Ваша логика здесь
    }
}

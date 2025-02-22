<?php

namespace App\Http\Controllers;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainClientController extends Controller
{
    public function router(){
        return view('MainClient');
    }

    public function AllOrder(){


       return view('MainClient',['date'=>freelansmain::all()]);

    }






}

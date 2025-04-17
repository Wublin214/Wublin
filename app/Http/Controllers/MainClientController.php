<?php

namespace App\Http\Controllers;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainClientController extends Controller
{

    //перекидывает на основную страницу клиента с массивом данных содержащий все заказы
    public function router(){
        return view('Client.MainClient',['date'=>freelansmain::all()]);
    }








}

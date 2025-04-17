<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\freelansmain;
use Illuminate\Http\Request;

class MainMasterController extends Controller
{
    //перекидывает на основную страницу мастера с массивом данных содержащий всех клиентов
    public function router() {
        $clients = Client::all();
        return view('Master.MainMaster', compact('clients'));
    }
}

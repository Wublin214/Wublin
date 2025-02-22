<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\freelansmain;
use Illuminate\Http\Request;

class MainMasterController extends Controller
{
    public function router() {
        $clients = Client::all();
        return view('MainMaster', compact('clients'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{


    public function OrderView(Request $request)
    {

        $data = freelansmain::where('id', $request->input('id'))->get();

        return view('page', ['data' => $data]);
    }

}

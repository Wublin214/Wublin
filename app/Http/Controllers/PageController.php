<?php

namespace App\Http\Controllers;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{


    public function OrderView(Request $request)
    {
//принимает значение id и ищет по нему заказ
        $data = freelansmain::where('id', $request->input('id'))->get();
//перекидывает на сраницу с заказом и его содержимом
        return view('Master.MasterOrderPage', ['data' => $data]);
    }

}

<?php

namespace App\Http\Controllers;
use App\Models\application;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Predis\Command\Redis\AUTH;

class PageController extends Controller
{


    public function OrderView(Request $request)
    {
//принимает значение id и ищет по нему заказ
        $data = freelansmain::where('id', $request->input('id'))->get();
//перекидывает на сраницу с заказом и его содержимом


        return view('Master.MasterOrderPage', ['data' => $data]);
    }

    public function TakeOrder(Request $request)
    {
        $id_order = $request->Id_Orders;
        $id_client = auth()->id();
        $id_master = $request->Id_master;

        $CheckApplication = application::where('client_id', $id_client)
            ->where('order_id', $id_order)
            ->where('master_id', $id_master)
            ->first();

        if ($CheckApplication) {

            return redirect()
                ->route('Order', ['id' => $id_order])
                ->with('info', 'Вы уже взяли этот заказ!');
        } else {
            $request->merge([
                'client_id' => $id_client,
                'order_id' => $id_order,
                'master_id' => $id_master,
            ]);

            $validated = $request->validate([
                'client_id' => 'required|integer',
                'order_id' => 'required|integer',
                'master_id' => 'required|integer',
            ]);

            application::create($validated);


            return redirect()
                ->route('Order', ['id' => $id_order])
                ->with('success', 'Заказ успешно взят!');
        }
    }

}

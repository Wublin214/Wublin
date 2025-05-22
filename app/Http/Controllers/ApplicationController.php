<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function router(){


        $IdMaster = Auth::id();

        $application = application::join('freelansmains', 'freelansmains.master_id', '=', 'applications.master_id')
            ->join('clients','clients.id','=','applications.client_id')
            ->select('applications.order_id AS IdOrder','firstName','lastName','ProjectTitle','text','applications.id AS IdApplication')
            ->where('applications.master_id', $IdMaster)
            ->get();


        return view('Master.Application',['date'=>$application]);
    }




    public function AcceptApplication(Request $request){

        $IdOrder = $request->IdOrderAccept;

        $UpdateOrder = freelansmain::where('id','=',$IdOrder)->update(['status'=>'accept']);

        return redirect()->route('MasterProfile');
    }


    public function RejectApplication(Request $request){

        $application = Application::findOrFail($request->IdApplication);
        $application->forceDelete();
    return redirect()->route('MasterProfile');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\PortfolioClients;
use App\Rules\NoBadWords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartfolioClientController extends Controller
{


    public function Partfolio(){

        $data = PortfolioClients::where('Client_id', '=', Auth::guard('clients')->id())->get();

        return view('Client.PartfolioClient', ['date' => $data]);

    }

    public function NewPortfolio(){

        return view('Client.AddPortfolioClient');
    }
    public function PostNewPortfolio(Request $request){

        $validate = $request->validate([

            'projectName' => ['required','max:255','string','alpha',new NoBadWords()],

            'projectDescription' =>['required','max:255','string','alpha',new NoBadWords()],

            'projectPhotos' =>['file','mimes:jpg,png','max:2048',new NoBadWords()],

        ]);

        $NewPortfolio = PortfolioClients::create([

            'Client_id' => Auth::guard('clients')->user()->id,
            'photo' => $request->projectPhotos,
            'title' => $request->projectName,
            'description' =>$request->projectDescription,

        ]);


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PortfolioClients;
use App\Rules\NoBadWords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartfolioClientController extends Controller
{


    public function Partfolio(){

        $data = PortfolioClients::where('Client_id', '=', Auth::guard('clients')->id())->get();

        return view('Client.PartfolioClient', ['date' => $data]);

    }

    public function NewPortfolio(){

        return view('Client.AddPortfolioClient');
    }

    public function PostNewPortfolio(Request $request) {

        $validate = $request->validate([
            'projectName' => ['required', 'max:255', 'string', 'alpha', new NoBadWords()],
            'projectDescription' => ['required', 'max:255', 'string', 'alpha', new NoBadWords()],
            'projectPhotos' => ['required', 'file', 'mimes:jpg,png', 'max:2048', new NoBadWords()],
        ]);


        $photoPath  = $request->file('projectPhotos')->hashName();
        Storage::disk('portfolio')->put($photoPath, file_get_contents($request->file('projectPhotos')));

        $client_id  = Auth::guard('clients')->user()->id;
        $NewPortfolio = PortfolioClients::create([
            'Client_id' => $client_id,
            'photo' => $photoPath,
            'title' => $request->projectName,
            'description' => $request->projectDescription,
        ]);

        return response()->redirectTo(route('Partfolio'));
    }
}

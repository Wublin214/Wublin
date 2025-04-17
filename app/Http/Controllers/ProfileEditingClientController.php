<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Rules\NoBadWords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use const http\Client\Curl\Versions\CURL;

class ProfileEditingClientController extends Controller
{
    public function router(){

        return view('Client.ProfileEditingClient');
    }

    public function postEditing(Request $request){

//верификация данных которые ввел пользователь

            $validated = $request->validate([
                  'imag' => ['file','mimes:jpg,png','max:2048', new NoBadWords],
                  "firstName" => ['alpha','string','max:50', new NoBadWords],
                  "lastName" => ['alpha','string','max:50', new NoBadWords],
                  "text" => ['nullable','string', new NoBadWords],
                  "textEducation" => ['nullable','string', new NoBadWords],
                  "phone" => ['nullable','string','max:12', new NoBadWords],
                  "telegram" => ['alpha','string','max:255', new NoBadWords],
                  "vk" => ['alpha','string','max:255', new NoBadWords],

            ]);
             // хешируеться фотографя
        if ($request->hasFile('imag')) {
            //береться хешируемое название фотография с её раширением
            $imagClients = $request->file('imag')->hashName();
            //береться из бд фотография у пользователя
            $oldPhotoClients =  Auth::guard('clients')->user()->imag;
            //если фотография у пользователя есть фотография
            if (Storage::disk('photo')->exists($oldPhotoClients)) {
                //фотографиия удаляеться в файле и записываться новая фотография
                Storage::disk('photo')->delete($oldPhotoClients);
                Storage::disk('photo')->put($imagClients, file_get_contents($request->file('imag')));

            }else{
                Storage::disk('photo')->put($imagClients, file_get_contents($request->file('imag')));
            }



        } else {
            // Если файл не загружен, берем изображение из базы данных
            $imagClients = Auth::guard('clients')->user()->imag;
        }
//обновляються дфнные о пользователе в бд
            auth()->user()->update([

                'imag' => $imagClients ,
                "firstName" => $request->input('firstName') ,
                "lastName" => $request->input('lastName') ,
                "text" => $request->input('text') ,
                "textEducation" => $request->input('textEducation') ,
                "phone" => $request->input('phone') ,
                "telegram" =>$request->input('telegram')  ,
                "vk" =>$request->input('vk')  ,

            ]);

            return redirect()->route('ClientProfile');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\freelansmain;
use Illuminate\Http\Request;

class MainMasterController extends Controller
{
    public function router() {
        return view('MainMaster');
    }

    public function AllFreelansers() {
        return view('MainMaster', ['date' => Client::all()]);
    }
    public function CreateFreelansersCard(){

//        $OrderData = freelansmain::all();
//
//        foreach ($OrderData as $row){
//
//            $pageContent = view('page', [
//                'pageId' => $row->id,
//                'projectTitle' => $row->ProjectTitle,
//                'projectDescription' => $row->ProjectDescription,
//                'typeOfWebsite' => $row->TypeOfWebsite,
//                'designPreferences' => $row->DesignPreferences,
//                'functionalRequirements' => $row->FunctionalRequirements,
//                'timeline' => $row->Timeline,
//                'budget' => $row->Budget,
//                'content' => $row->Content,
//                'seoConsiderations' => $row->SEOConsiderations,
//                'contactInformation' => $row->ContactInformation,
////                'idMaster' => $row->master_id,
//            ])->render();
//            file_put_contents("pages/order{$row->id}.blade.html", $pageContent);
//

            $FreelansDate = Client::all();

        foreach ($FreelansDate as $row){

            $PageContent = view('card',[

                'id' =>$row->id,
                'firstName' =>$row->firstName,
                'lastName' =>$row->lastName,
                'email' =>$row->email,
                'gender' =>$row->gender,
                'imag' =>$row->imag,
                'Text' =>$row->Text,
                'portfolio1' =>$row->portfolio1,
                'portfolio2' =>$row->portfolio2,
                'portfolio3' =>$row->portfolio3,




            ])->render();
            file_put_contents("public/card/freelanser{$row->id}.blade.html", $PageContent);

        }
    }

}

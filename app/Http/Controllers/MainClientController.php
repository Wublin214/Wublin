<?php

namespace App\Http\Controllers;
use App\Models\freelansmain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainClientController extends Controller
{
    public function router(){
        return view('MainClient');
    }

    public function AllOrder(){


       return view('MainClient',['date'=>freelansmain::all()]);

    }

    public function CreateAllPagesOrder(){

        $OrderData = freelansmain::all();

        foreach ($OrderData as $row){

            $pageContent = view('page', [
                'pageId' => $row->id,
                'projectTitle' => $row->ProjectTitle,
                'projectDescription' => $row->ProjectDescription,
                'typeOfWebsite' => $row->TypeOfWebsite,
                'designPreferences' => $row->DesignPreferences,
                'functionalRequirements' => $row->FunctionalRequirements,
                'timeline' => $row->Timeline,
                'budget' => $row->Budget,
                'content' => $row->Content,
                'seoConsiderations' => $row->SEOConsiderations,
                'contactInformation' => $row->ContactInformation,
//                'idMaster' => $row->master_id,
            ])->render();
            file_put_contents("pages/order{$row->id}.blade.html", $pageContent);


        }
    }



}

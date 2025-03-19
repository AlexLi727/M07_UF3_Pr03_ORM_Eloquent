<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public static function readActors(){
        $actors = DB::table("actors")->get();

        return $actors;
    }

    public function countActors(){
        $actors = ActorController::readActors();
        $contador = 0;

        foreach($actors as $actor){
            $contador++;
        }

        return view("actors.count", ["contador" => $contador]);
    }

    public function listActors(){
        $actors = json_decode(ActorController::readActors(), true);
        
        return view("actors.list", ["actors" => $actors]);
    }

    public function listActorsByDecade(Request $request){
        $decade = $request->input("decade");
       
        if(is_null($decade))
            return view();

        $actors = json_decode(ActorController::readActors(), true);
        $filtredActors = [];

        foreach($actors as $actor){
            $birthdate = substr($actor["birthdate"], 0, -6);
            if($birthdate >= $decade && $birthdate < $decade + 10){
                $filtredActors[] = $actor;
            }
        }
        return view("actors.list", ["actors" => $filtredActors]);

    }
}
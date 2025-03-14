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
}
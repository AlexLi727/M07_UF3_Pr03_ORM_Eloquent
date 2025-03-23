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
        
        return view("actors.list", ["actors" => $actors, "title" => "Lista de actores"]);
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
        return view("actors.list", ["actors" => $filtredActors, "title" => "Lista de actores por decada ($decade - ".($decade + 9).")"]);

    }

    public function destroy($id = null){
        db::table('actors')->where("id", $id)->delete();
        return response()->json([
            "action" => "delete",
            "status" => true
        ]);
    }

    public function update(Request $request, $id = null){
        $name = $request->input("name");
        $surname = $request->input("surname");
        $birthdate = $request->input("birthdate");
        $country = $request->input("country");
        $img_url = $request->input("img_url");

         DB::table("actors")->where("id", $id)->update([
            "name" => $name,
            "surname" => $surname,
            "birthdate" => $birthdate,
            "country" => $country,
            "img_url" => $img_url,
            "updated_at" => now()
         ]);

         return response()->json([
            "action" => "update",
            "status" => true
        ]);
    }
}
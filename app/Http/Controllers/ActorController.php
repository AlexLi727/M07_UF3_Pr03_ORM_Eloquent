<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Models\Actor;

class ActorController extends Controller
{
    public static function readActors(){
        return Actor::get();
    }

    public function countActors(){
        $actors = Actor::count();
        return view("actors.count", ["contador" => $actors]);
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
        $actor = Actor::findOrNew($id)->delete();
        if(!$actor){
            return response()->json([
                "action" => "delete",
                "status" => false
            ]);
        }

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

        $actor = DB::table('actors')->where('id', $id)->first();
        if(!$actor || is_null($name) || is_null($surname) || is_null($birthdate) || is_null($country)){
            return response()->json([
                "action" => "update",
                "status" => false
            ]);
        }

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

    public function indexActors(){
        $actor = Actor::with('films')->get();
        
        return response()->json($actor);
    }
}
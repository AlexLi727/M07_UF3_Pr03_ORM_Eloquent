<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Models\Film;

class FilmController extends Controller
{
    

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        $filmsDatabase = FilmController::readFilmsDatabase();
        $filmsDatabase = json_decode($filmsDatabase, true);
        foreach($filmsDatabase as $film){
            $newFilm = array(
                "name" => $film["name"],
                "year" => $film["year"],
                "genre" => $film["genre"],
                "country" => $film["country"],
                "duration" => $film["duration"],
                "img_url" =>$film["img_url"]
            );
            array_push($films, $newFilm);
        }
        return $films;
    }

    public static function readFilmsDatabase(){
        $films = Film::get();
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();
        

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function filmsByYear(int $year = null){
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        if(is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach($films as $film){
            if($film["year"] == $year){
                $films_filtered[] = $film;
            }
        }
        $title = "Listado de peliculas del año ". $year;
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function filmsByGenre(String $genre = null){
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        if(is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach($films as $film){
            if(strtolower($film["genre"]) === strtolower($genre)){
                $films_filtered[] = $film;
            }
        }
        $title = "Listado de peliculos por genero ". $genre;
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function sortFilms(){
        $films = FilmController::readFilms();
        $title = "Pelis ordenadas por fecha";
        $sortedFilms = asort($films);

        return view('films.list',["films" => $sortedFilms, "title" => $title]);
        
    }

    public function countFilms(){
        $films = DB::table('films')->count();
        
        return view('films.count',["contador"=>$films]);
    }

    public function isFilm(String $name = null){
        $films = FilmController::readFilms();
        foreach($films as $film){
            if(strtolower($film["name"]) == strtolower($name)){
                return true;
            }
        }
        return false;
    }

    public function createFilm(Request $request){
        $flag = config('api.FLAG');
        
        
        $name = $request->input("name");
        if(FilmController::isFilm($name)){
            return view('welcome',["status" => "La película ya existe"]);
        }
        $year = $request->input("year");
        $genre = $request->input("genre");
        $country = $request->input("country");
        $duration = $request->input("duration");
        $img_url = $request->input("img");

        if($flag == "JSON"){
            $json = Storage::json('/public/films.json');
            
            $newFilm = ["name"=> $name, "year"=> $year, "genre"=> $genre, "country"=> $country, "duration" => $duration, "img_url" => $img_url];

            $json[] = $newFilm;
            Storage::put('/public/films.json', json_encode($json));
        }
        
        if($flag == "BBDD"){
        DB::table("films")->insert([
            "name" => $name,
            "year" => $year,
            "genre" => $genre,
            "country" => $country,
            "duration" => $duration,
            "director_id" => 5,
            "img_url" => $img_url,
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
        return redirect()->action('App\Http\Controllers\FilmController@listFilms');


    }
}

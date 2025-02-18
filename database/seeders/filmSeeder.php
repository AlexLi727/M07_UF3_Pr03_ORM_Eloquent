<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class filmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i < 11; $i++){
            DB::table("film")->insert(array(
                "name" => "Pelicula$i",
                "year" => 2005,
                "genre" => "Accion$i",
                "country" => "Spain$i",
                "duration" => $i,
                "img_url" => ""
            ));
        }
    }
}

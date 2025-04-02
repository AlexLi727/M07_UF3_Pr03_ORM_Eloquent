<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
require_once 'vendor/autoload.php';
class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for($i = 1; $i < 10; $i++){
            DB::table("films")->insert(
                [
                    "id" => $i,
                    "name" => $faker->word(),
                    "year" => $faker->year(),
                    "genre" => $faker->word(),
                    "country" => $faker->country(),
                    "duration" => rand(60, 240),
                    "director_id" => $faker->randomDigitNotZero(),
                    "img_url" => $faker->imageUrl(),
                    "created_at" => now(),
                    "updated_at" => now()
                ]
                );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++){
            DB::table("film_actor")->insert(
                [
                    "film_id" => $faker->randomDigitNotZero(),
                    "actor_id" => $faker->randomDigitNotZero(),
                    "created_at" => now(),
                    "updated_at" => now()
                ]
                );
        }
    }
}

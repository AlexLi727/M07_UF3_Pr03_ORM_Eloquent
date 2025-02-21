<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++){
            DB::table("actors")->insert(
                [
                    "name" => $faker->name(),
                    "surname" => $faker->lastName(),
                    "birthdate" => $faker->dateTime(),
                    "country" => $faker->country(),
                    "img_url" => $faker->imageUrl(),
                    "created_at" => now(),
                    "updated_at" => now()
                ]
                );
        }
    }
}

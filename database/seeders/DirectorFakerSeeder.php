<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class DirectorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for($i = 1; $i < 10; $i++){
            DB::table("directors")->insert(
         [
                    "id" => $i,
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

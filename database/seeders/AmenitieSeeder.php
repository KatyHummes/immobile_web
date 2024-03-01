<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AmenitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = DB::table('immobiles')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            DB::table('amenities')->insert([
                'immobile_id' => $faker->randomElement($userIds),
                'tv' => $faker->boolean,
                'wifi' => $faker->boolean,
                'air_conditioning' => $faker->boolean,
                'bathroom' => $faker->boolean,
                'moving' => $faker->boolean,
                'furnished' => $faker->boolean,
                'garage' => $faker->boolean,
                'ordinance' => $faker->boolean,
                'reservation' => $faker->boolean,
                'maintenance' => $faker->boolean,
                'payment' => $faker->boolean,
                'couple' => $faker->boolean,
                'smoker' => $faker->boolean,
                'pets' => $faker->boolean,
                'visits' => $faker->boolean,
            ]);
        }
    }
}

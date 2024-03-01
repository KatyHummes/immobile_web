<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ImmobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('immobiles')->insert([
                'user_id' => 1,
                'title' => $faker->sentence,
                'description' => $faker->text,
                'price' => $faker->randomFloat(2, 100, 1000),
                'street' => $faker->streetName,
                'number' => $faker->buildingNumber,
                'neighborhood' => $faker->city,
                'city' => $faker->city,
                'state' => $faker->state,
            ]);
        }
    }
}

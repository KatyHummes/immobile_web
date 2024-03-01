<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = DB::table('immobiles')->pluck('id')->toArray();
        $photoDir = './photos/';

        foreach (range(1, 10) as $index) {
            $photoFilename = uniqid('photo_') . '.jpg'; 
            $photoPath = $photoDir . $photoFilename;

            DB::table('photos')->insert([
                'immobile_id' => $faker->randomElement($userIds),
                'photo_path' => $photoPath,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
			'name' => 'Katieli Hummes',
			'email' => 'Katielihummes15@gmail.com',
			'password' => Hash::make('123123123'),
		]);

    }
}

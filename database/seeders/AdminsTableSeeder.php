<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [];

        for ($i = 0; $i <= 15; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $i == 0 ? 'admin@gmail.com' : fake()->email,
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('admins')->insert($data);
    }
}

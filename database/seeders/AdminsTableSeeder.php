<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CustomRole;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [];
        if(empty($user)){
            $admin = Admin::create([
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'status' => Admin::STATUS_ACTIVE,
                'password' => '$2y$10$HuH7XLvwYD6oJdUKFNPL5eGHZ94pXxtVvWyKk4usMc2wcT7655452',
                'role_id' => 1, // role_id = 1 is 'Super Admin
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 0; $i <= 15; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' =>  fake()->email,
                'password' => Hash::make('123456'),
                'role_id' => random_int(1,3),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('admins')->insert($data);


    }
}

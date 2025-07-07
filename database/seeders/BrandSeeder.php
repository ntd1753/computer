<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $brands = [
            'GVN', //0
            'Intel', //1
            'AMD', //2
            'Dell', //3
            'Acer', //4
            'HP', //5
            'Lenovo', //6
            'Apple', //7
            'Razer', //8
            'Logitech', //9
            'NVIDIA', //10
            'Asus', //11
            'MSI', //12
            'Gigabyte', //13
            'Corsair', //14
            'Samsung', //15
            'Kingston', //16
            'Western Digital', //17
            'Microsoft', //18
        ];

        $data = [];
        foreach ($brands as $brand) {
            $data[] = [
                'name' => $brand,
                'logo' => $faker->imageUrl(100, 100, 'technics', true, $brand), // URL hình ảnh giả từ Faker
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('brands')->insert($data);
    }
}

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
            'Intel',
            'AMD',
            'NVIDIA',
            'Asus',
            'MSI',
            'Gigabyte',
            'Corsair',
            'Samsung',
            'Kingston',
            'Western Digital',
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

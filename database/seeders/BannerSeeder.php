<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Khuyến mãi Laptop Gaming',
                'image' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/banner/4.jpg',
                'position' => 2,
                "status" => Banner::STATUS_ACTIVE,

                'link' => '#',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Khuyến mãi PC gaming',
                'position' => 2,
                'status' => Banner::STATUS_ACTIVE,
                'image' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/banner/2.jpg',
                'link' => '/pc-gaming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Khuyến mãi PC AI',
                'position' => 2,
                "status" => Banner::STATUS_ACTIVE,

                'image' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/11_Feb7f0457f353d0604ef5d3e79cf508b394.webp',
                'link' => '/pc-gaming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Khuyến mãi linh kiện máy tính',
                'image' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/banner/5.jpg',
                "position" => 1,
                'link' => '/linh-kien-may-tinh',
                "status" => Banner::STATUS_ACTIVE,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Khuyến mãi linh kiện máy tính',
                'image' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/banner/6.jpg',
                "position" => 1,
                "status" => Banner::STATUS_ACTIVE,
                'link' => '/linh-kien-may-tinh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($data as $banner) {
            DB::table('banners')->insert($banner);
        }
    }
}

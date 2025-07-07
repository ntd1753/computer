<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\CPU;
use App\Models\Filter;
use App\Models\LaptopAndPrebuiltPc;
use App\Models\Post;
use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CpuIntelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Tạo instance Faker

        $json = file_get_contents(database_path('seeders/data-crawl/cpu-intel.json'));
        $cpus = json_decode($json, true); // Giải mã thành mảng

        foreach ($cpus as $cpu) {
            $discount_type = Arr::random([99, 1, null]);
            if ($discount_type == 1){
                $discount_value = Arr::random([5, 10, 15, 20, 25]);
            } else if ($discount_type == 99){
                $discount_value = $faker->numberBetween(100000, 500000);
            } else {
                $discount_value = null;
            }
            $cpuDetail = CPU::create([
                "core_series" => $cpu['tags']['core_series'],
                "core_type" => $cpu['tags']['core_type'],
                "socket" => $cpu['tags']['socket'],
            ]);
            $accessory = Accessory::create([
                "type" => Accessory::TYPE_CPU,
                "detail_id" => $cpuDetail->id,
                "data_sheet" => $cpu['table'],
            ]);
            $post = Post::create([
                'type' => "PRODUCT",
                'content' => $cpu['body_html'],
                'images' => json_encode([
                    $faker->imageUrl(640, 480, 'business', true),
                    $faker->imageUrl(640, 480, 'technology', true),
                ]),
                'seo_title' =>  $cpu['title'],
                'seo_keywords' => $cpu['title'],
                'seo_description' => $cpu['title'],
                'author_id' => 1, // Assuming you have 10 authors
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $product = Product::create([
                'name' => $cpu['title'],
                'slug' => Str::slug($cpu['title']),
                'brand_id' => 2,
                'type' => Product::TYPE_ACCESSORY,
                'cost' => $cpu['cost'],
                'price' => $cpu['price'] ==0 ? $cpu['cost'] + 1000000 : $cpu['price'],
                'images' => $cpu['images'],
                'post_id' => $post->id,
                'category_id' => 9,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'detail_id' => $accessory->id,
                'quantity' => rand(10,100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}

<?php

namespace Database\Seeders;

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

class PcGamingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Tạo instance Faker

        $json = file_get_contents(database_path('seeders/data-crawl/pc-gaming.json'));
        $prebuiltPCs = json_decode($json, true); // Giải mã thành mảng

        foreach ($prebuiltPCs as $prebuiltPC) {
            $discount_type = Arr::random([99, 1, null]);
            if ($discount_type == 1){
                $discount_value = Arr::random([5, 10, 15, 20, 25]);
            } else if ($discount_type == 99){
                $discount_value = $faker->numberBetween(1000000, 3000000);
            } else {
                $discount_value = null;
            }
            if($prebuiltPC['price']<=15000000){
                $categoryId=33;
            }elseif ($prebuiltPC['price'] <= 25000000){
                $categoryId=34;
            }else{
                $categoryId=35;
            }

            $prebuiltPCRecord = LaptopAndPrebuiltPc::create([
                'product_type' => Product::TYPE_PC,
                'screen_size' => null,
                'cpu' => $prebuiltPC["tags"]['cpu'],
                'ram' => $prebuiltPC["tags"]['ram'],
                'ram_memory' =>$prebuiltPC["tags"]['ram_type'] ?? 'DDR4',
                'battery_life' => null,
                'vga' => $prebuiltPC["tags"]['vga'] ?? null,
                'mainboard' => $prebuiltPC["tags"]['mainboard'],
                'power_supply' => $prebuiltPC["tags"]['power_supply'],
                'cpu_fan' => $prebuiltPC["tags"]['cpu_fan']?? null,
                'hdd_size' => $prebuiltPC["tags"]['hdd_size'] ?? null,
                'ssd_size' => $prebuiltPC["tags"]['ssd_size'] ?? null,
                'data_sheet' => $prebuiltPC['table'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $prebuiltPcId = $prebuiltPCRecord->id;
            $post = Post::create([
                'type' => "PRODUCT",
                'content' => $prebuiltPC['body_html'],
                'images' => json_encode([
                    $faker->imageUrl(640, 480, 'business', true),
                    $faker->imageUrl(640, 480, 'technology', true),
                ]),
                'seo_title' =>  $prebuiltPC['title'],
                'seo_keywords' => $prebuiltPC['title'],
                'seo_description' => $prebuiltPC['title'],
                'author_id' => 1, // Assuming you have 10 authors
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $product = Product::create([
                'name' => $prebuiltPC['title'],
                'slug' => Str::slug($prebuiltPC['title']),
                'brand_id' => 1,
                'type' => Product::TYPE_PC,
                'cost' => $prebuiltPC['cost'],
                'price' => $prebuiltPC['price'],
                'images' => $prebuiltPC['images'],
                'post_id' => $post->id,
                'category_id' => $categoryId,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'detail_id' => $prebuiltPcId,
                'quantity' => rand(10,100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}

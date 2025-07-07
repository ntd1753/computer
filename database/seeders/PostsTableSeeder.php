<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];
        $images = [
            'https://gcs.tripi.vn/public-tripi/tripi-feed/img/482887bCy/anh-mo-ta.png',
            'https://media.istockphoto.com/id/1212064060/vi/anh/l%C6%B0%E1%BB%9Bi-lu%E1%BB%93ng-d%E1%BB%AF-li%E1%BB%87u-abs-hologram.jpg?s=612x612&w=0&k=20&c=2IRs6J1TRCQUMzxuPfRK-lyuFKwSKswC8F-Bid526iw=',
            'https://gcs.tripi.vn/public-tripi/tripi-feed/img/474082hca/hinh-nen-cong-nghe-3d-tuyet-dep_011901928.jpg',
            'https://png.pngtree.com/background/20210709/original/pngtree-blue-artificial-intelligent-technology-picture-image_956962.jpg',
            'https://www.nait.vn/uploads/news/2023/02/1_9.jpg',
            ];
        for ($i = 1; $i <= 10; $i++) { // Seed 100 bản ghi
            $type = "POST";
            $data[] = [
                'title' => $faker->sentence,
                'type' => $type,
                'slug' => Str::slug($faker->sentence),
                'description' => $faker->text(200),
                'content' => $faker->paragraphs(3, true),
                'images' =>
                    $images[array_rand($images)],

                'seo_title' => $faker->sentence,
                'seo_keywords' => $faker->words(5, true),
                'seo_description' => $faker->text(150),
                'author_id' => $faker->numberBetween(1, 10), // Assuming you have 10 authors
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        for ($j=1; $j<=150; $j++){
            $type = "PRODUCT";
            $data[] = [
                'title' => $faker->sentence,
                'type' => $type,
                'slug' => Str::slug($faker->sentence),
                'description' => $faker->text(200),
                'content' => $faker->paragraphs(3, true),
                'images' => json_encode([
                    $faker->imageUrl(640, 480, 'business', true),
                    $faker->imageUrl(640, 480, 'technology', true),
                ]),
                'seo_title' => $faker->sentence,
                'seo_keywords' => $faker->words(5, true),
                'seo_description' => $faker->text(150),
                'author_id' => $faker->numberBetween(1, 10), // Assuming you have 10 authors
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('posts')->insert($data);
    }
}


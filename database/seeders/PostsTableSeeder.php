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

        for ($i = 1; $i <= 10; $i++) { // Seed 100 bản ghi
            $type = "POST";
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


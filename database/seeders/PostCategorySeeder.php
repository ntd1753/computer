<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Categories = [
            ['name' => 'Công nghệ', 'slug' => Str::slug('Công nghệ')],
            ['name' => 'Review sản phẩm', 'slug' => Str::slug('Review sản phẩm')],
            ['name' => 'Tin khuyến mại', 'slug' => Str::slug('Tin khuyến mại')],
            ['name' => 'Game', 'slug' => Str::slug('Game')],
        ];
        foreach ($Categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'type' => Category::TYPE_BLOG,
                'parent_id' => null,
            ]);
        }
    }
}

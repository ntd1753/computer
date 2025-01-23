<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Danh mục cha (Parent Categories)
        $parentCategories = [
            ['name' => 'CPU', 'icon' => 'fa-microchip', 'slug' => Str::slug('CPU')],
            ['name' => 'Main board', 'icon' => 'fa-motherboard', 'slug' => Str::slug('Motherboard')],
            ['name' => 'RAM', 'icon' => 'fa-memory', 'slug' => Str::slug('RAM')],
            ['name' => 'Card Đồ Họa', 'icon' => 'fa-gpu', 'slug' => Str::slug('Graphics Card')],
            ['name' => 'Storage', 'icon' => 'fa-hdd', 'slug' => Str::slug('Storage')],
            ['name' => 'Power Supply', 'icon' => 'fa-bolt', 'slug' => Str::slug('Power Supply')],
            ['name' => 'PC Case', 'icon' => 'fa-desktop', 'slug' => Str::slug('PC Case')],
        ];

        foreach ($parentCategories as $parent) {
            $parentId = DB::table('categories')->insertGetId(array_merge($parent, [
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            // Danh mục con (Subcategories) tương ứng
            $subcategories = [];

            switch ($parent['name']) {
                case 'CPU':
                    $subcategories = ['Intel', 'AMD'];
                    break;
                case 'Motherboard':
                    $subcategories = ['ATX', 'Micro-ATX', 'Mini-ITX'];
                    break;
                case 'RAM':
                    $subcategories = ['DDR4', 'DDR5'];
                    break;
                case 'Graphics Card':
                    $subcategories = ['NVIDIA', 'AMD Radeon'];
                    break;
                case 'Storage':
                    $subcategories = ['HDD', 'SSD', 'NVMe SSD'];
                    break;
                case 'Power Supply':
                    $subcategories = ['Modular', 'Semi-Modular', 'Non-Modular'];
                    break;
                case 'PC Case':
                    $subcategories = ['Full Tower', 'Mid Tower', 'Mini Tower'];
                    break;
            }

            foreach ($subcategories as $subcategory) {
                DB::table('categories')->insert([
                    'name' => $subcategory,
                    'parent_id' => $parentId,
                    'icon' => 'fa-cube',
                    'slug' => Str::slug($parent['name'] . ' ' . $subcategory),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

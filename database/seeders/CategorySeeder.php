<?php

namespace Database\Seeders;

use App\Models\Category;
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
            ['name' => 'Laptop', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/laptop.png', 'slug' => Str::slug('Laptop')],
            ['name' => 'Linh Kiện Máy Tính', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/computer-components.png', 'slug' => Str::slug('Accessories')],
            ['name' => 'PC Đồ Họa, Render 3D', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/pc-render.png', 'slug' => Str::slug('PC Đồ Họa, Render 3D')],
            ['name' => 'PC Gaming', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/pc-gaming.png', 'slug' => Str::slug('PC Gaming')],
            ['name' => 'PC Văn Phòng', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/office-computer.png', 'slug' => Str::slug('PC Văn Phòng')],
            ['name' => 'Server, Máy Ảo, Giả Lập', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/pc-server.png', 'slug' => Str::slug('Server, Máy Ảo, Giả Lập')],
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
                case 'Laptop':
                    $subcategories = ['Laptop Gaming', 'Laptop - Notebook Văn phòng'];
                    break;
                case 'Linh Kiện Máy Tính':
                    $subcategories = ['Mainboard - Bo mạch chủ',
                        'CPU - Bộ vi xử lý', 'VGA - Card màn hình',
                        'PSU - Nguồn máy tính', 'Case - Vỏ máy tính',
                        'RAM-Bộ nhớ trong',
                        'SSD - Ổ cứng SSD',
                        'HDD - Ổ cứng HDD',
                        'Tản nhiệt Cooling',
                        ];
                    break;
                case 'PC Đồ Họa, Render 3D':
                    $subcategories = ['PC Render 3D', 'PC Thiết kế đồ họa'];
                    break;
                case 'PC Gaming':
                    $subcategories = ['PC Gaming giá rẻ', 'PC Gaming tầm trung', 'PC Gaming cao cấp'];
                    break;
                case 'PC Văn Phòng':
                    $subcategories = ['PC Văn Phòng giá rẻ', 'PC Văn Phòng tầm trung', 'PC Văn Phòng cao cấp', 'PC trọn bộ'];
                    break;
                case 'Server, Máy Ảo, Giả Lập':
                    $subcategories = ['Server', 'Máy ảo', 'Máy giả lập'];
                    break;
            }

            foreach ($subcategories as $subcategory) {
                $subcategoryId=DB::table('categories')->insertGetId([
                    'name' => $subcategory,
                    'parent_id' => $parentId,
                    'icon' => null,
                    'slug' => Str::slug($subcategory),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if (in_array($subcategory, [
                    'Mainboard - Bo mạch chủ',
                    'CPU - Bộ vi xử lý',
                    'VGA - Card màn hình',
                    'PSU - Nguồn máy tính',
                    'Case - Vỏ máy tính',
                    'RAM-Bộ nhớ trong',
                    'SSD - Ổ cứng SSD',
                    'HDD - Ổ cứng HDD',
                    'Tản nhiệt Cooling',
                ])) {
                    $subSubcategories = [];
                    switch ($subcategory) {
                        case 'Mainboard - Bo mạch chủ':
                            $subSubcategories = [
                                "Mainboard Intel",
                                "Mainboard AMD",
                            ];
                            break;
                        case 'CPU - Bộ vi xử lý':
                            $subSubcategories = ["CPU Intel", "CPU AMD"];
                            break;
                        case 'VGA - Card màn hình':
                            $subSubcategories = [
                                "VGA NVIDIA",
                                "VGA Radeon",
                            ]
                            ;
                            break;
                        case 'RAM-Bộ nhớ trong':
                            $subSubcategories = [
                                "Ram DDR4",
                                "Ram DDR5",
                            ]
                            ;
                            break;
                        case 'SSD - Ổ cứng SSD':
                            $subSubcategories = [
                                "SSD M.2 NVMe",
                                "SSD M.2 SATA"
                            ]
                            ;
                            break;
                        case 'HDD - Ổ cứng HDD':
                            $subSubcategories = [
                               "HDD 3.5 inch",
                                "HDD 2.5 inch"
                            ];
                            break;
                        case 'Tản nhiệt Cooling':
                            $subSubcategories = [
                                "Tản nhiệt khí",
                                "Tản nhiệt nước AIO",
                                "Quạt tản nhiệt"
                            ];
                            break;
                    }

                    foreach ($subSubcategories as $subSubcategory) {
                        DB::table('categories')->insert([
                            'name' => $subSubcategory,
                            'parent_id' => $subcategoryId,
                            'icon' => null,
                            'slug' => Str::slug($subSubcategory),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        $categories= Category::all();
        foreach ($categories as $category) {
            $category->type = Category::TYPE_PRODUCT;
            $category->save();
        }

    }
}

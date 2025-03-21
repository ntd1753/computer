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
            ['name' => 'Laptop', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/laptop.png', 'slug' => Str::slug('Laptop')],
            ['name' => 'Linh Kiện Máy Tính', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/computer-components.png', 'slug' => Str::slug('Accessories')],
            ['name' => 'PC Đồ Họa, Render 3D', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/pc-render.png', 'slug' => Str::slug('PC Đồ Họa, Render 3D')],
            ['name' => 'PC Gaming', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/pc-gaming.png', 'slug' => Str::slug('PC Gaming')],
            ['name' => 'PC Văn Phòng', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/office-computer.png', 'slug' => Str::slug('PC Văn Phòng')],
            ['name' => 'Server, Máy Ảo, Giả Lập', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/pc-server.png', 'slug' => Str::slug('Server, Máy Ảo, Giả Lập')],
            ['name' => 'Phụ Kiện Máy Tính', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/gaming-gear.png', 'slug' => Str::slug('Phụ Kiện Máy Tính')],
            ['name' =>'Tản Nhiệt Cooling', 'icon' => 'https://cmscpt.s3.ap-southeast-1.amazonaws.com/category/cooling.png', 'slug' => Str::slug('Tản Nhiệt Cooling')]
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
                    $subcategories = ['Laptop - Notebook Gaming', 'Laptop - Notebook Văn phòng'];
                    break;
                case 'Linh Kiện Máy Tính':
                    $subcategories = ['Mainboard - Bo mạch chủ',
                        'CPU - Bộ vi xử lý', 'VGA - Card màn hình',
                        'PSU - Nguồn máy tính', 'Case - Vỏ máy tính',
                        'RAM-Bộ nhớ trong',
                        'SSD - Ổ cứng SSD',
                        'HDD - Ổ cứng HDD',];
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
                case 'Phụ Kiện Máy Tính':
                    $subcategories = ['Chuột máy tính', 'Bàn phím máy tính', 'Tai nghe máy tính', 'Loa máy tính',
                        'Webcam', 'Thiết bị mạng', 'USB', 'Ổ cứng di động', 'Thiết bị lưu trữ', 'Thiết bị khác'];
                    break;
                case 'Tản Nhiệt Cooling':
                    $subcategories = ['Tản nhiệt khí', 'Tản nhiệt nước AIO', 'Quạt Tản Nhiệt'];
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
                    'Tản nhiệt khí',
                    'Tản nhiệt nước AIO',
                    'Quạt tản nhiệt'
                ])) {
                    $subSubcategories = [];
                    switch ($subcategory) {
                        case 'Mainboard - Bo mạch chủ':
                            $subSubcategories = [
                                "Mainboard Intel Z790",
                                "Mainboard Intel B760",
                                "Mainboard Intel Z690",
                                "Mainboard Intel B660",
                                "Mainboard Intel H610",
                                "Mainboard Intel Z590",
                                "Mainboard Intel X299",
                                "Mainboard Khác",
                                "Mainboard AMD X670",
                                "Mainboard AMD X570",
                                "Mainboard AMD B650",
                                "Mainboard AMD B550",
                                "Mainboard AMD TRX40",
                                "Mainboard AMD B450",
                                "Mainboard AMD X870",
                                "Mainboard Intel Z890"
                            ];
                            break;
                        case 'CPU - Bộ vi xử lý':
                            $subSubcategories = [ "Intel Core i9",
                                "Intel Core i7",
                                "Intel Core i5",
                                "Intel Core i3",
                                "Intel Xeon",
                                "AMD Ryzen 5",
                                "AMD Ryzen 7",
                                "AMD Ryzen 9",
                                "AMD Ryzen Threadripper",
                                "Intel Core Ultra 5",
                                "Intel Core Ultra 7",
                                "Intel Core Ultra 9"];
                            break;
                        case 'VGA - Card màn hình':
                            $subSubcategories = [
                                "NVIDIA RTX 4090",
                                "NVIDIA RTX 4080",
                                "NVIDIA RTX 4070 4070Ti",
                                "NVIDIA RTX 4060 4060Ti",
                                "NVIDIA RTX 3080 3080Ti",
                                "NVIDIA RTX 3070 3070Ti",
                                "NVIDIA RTX 3060 3060Ti",
                                "NVIDIA RTX 3050",
                                "NVIDIA RTX 2060 Super",
                                "NVIDIA GTX 1650 Super",
                                "NVIDIA GTX 1660 1660Ti",
                                "NVIDIA GTX 1050 1050Ti",
                                "NVIDIA Quadro",
                                "VGA AMD Radeon",
                                "NVIDIA RTX 5090",
                                "NVIDIA RTX 5080",
                                "NVIDIA RTX 5070 5070Ti"
                            ]
                            ;
                            break;
                        case 'PSU - Nguồn máy tính':
                            $subSubcategories = [
                                "Nguồn Antec",
                                "Nguồn Asus",
                                "Nguồn Cooler Master",
                                "Nguồn Gigabyte",
                                "Nguồn Jetek",
                                "Nguồn MSI",
                                "Nguồn Super Flower",
                                "Nguồn Deepcool",
                                "Nguồn Huntkey",
                                "Nguồn NZXT",
                                "Nguồn Seasonic",
                                "Nguồn Thermaltake",
                                "Nguồn ALmordor"
                            ]
                            ;
                            break;
                        case 'Case - Vỏ máy tính':
                            $subSubcategories = [
                                "Case Antec",
                                "Case Asus",
                                "Case Cooler Master",
                                "Case Corsair",
                                "Case Deepcool",
                                "Case Jetek",
                                "Case MIK",
                                "Case Monteck",
                                "Case MSI",
                                "Case NZXT",
                                "Case Sama",
                                "Case Segotep",
                                "Case Xigmatek"
                            ]
                            ;
                            break;
                        case 'RAM-Bộ nhớ trong':
                            $subSubcategories = [
                                "Ram Server ECC - Registered",
                                "RAM KINGSTON",
                                "RAM TEAMGROUP",
                                "RAM ADATA",
                                "RAM GSKILL",
                                "RAM PNY",
                                "RAM Corsair",
                                "RAM Lexar",
                                "RAM KINGMAX"
                            ]
                            ;
                            break;
                        case 'SSD - Ổ cứng SSD':
                            $subSubcategories = [
                                "SSD Adata",
                                "SSD MSI",
                                "SSD PNY",
                                "SSD Colorfull",
                                "SSD Corsair",
                                "SSD Gigabyte",
                                "SSD Kingston",
                                "SSD TeamGroup",
                                "SSD Samsung",
                                "SSD Western Digital",
                                "SSD LEXAR",
                                "SSD CRUCIAL"
                            ]
                            ;
                            break;
                        case 'HDD - Ổ cứng HDD':
                            $subSubcategories = [
                                "HDD Seagate",
                                "HDD Toshiba",
                                "HDD Western Digital"
                            ];
                            break;
                        case 'Tản nhiệt khí':
                            $subSubcategories = [
                                "Tản Nhiệt Khí Noctua",
                                "Tản Nhiệt Khí Cooler Master",
                                "Tản Nhiệt Khí Deepcool",
                                "Tản Nhiệt Khí ID-Cooling",
                                "Tản Nhiệt Khí Thermalright",
                                "Tản nhiệt khí Jonsbo"
                            ];
                            break;
                        case 'Tản nhiệt nước AIO':
                            $subSubcategories = [
                                "Tản Nhiệt Nước Asus",
                                "Tản Nhiệt Nước Corsair",
                                "Tản Nhiệt Nước NZXT",
                                "Tản Nhiệt Nước MSI",
                                "Tản Nhiệt Nước Thermalright",
                                "Tản Nhiệt Nước Thermaltake",
                                "Tản Nhiệt Nước Cooler Master",
                                "Tản Nhiệt Nước DeepCool"
                            ];
                            break;
                        case 'Quạt tản nhiệt':
                            $subSubcategories = [
                            "Quạt tản nhiệt NZXT",
                            "Quạt tản nhiệt Thermalright",
                            "Quạt tản nhiệt Xigmatek",
                            "Quạt tản nhiệt Coolermaster",
                            "Quạt tản nhiệt EKWB",
                            "Quạt tản nhiệt ID-Cooling",
                            "Quạt tản nhiệt Jonsbo",
                            "Quạt tản nhiệt Kenoo"
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
    }
}

<?php

namespace Database\Seeders;

use App\Models\VGA;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class LaptopAndPrebuiltPCSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Tạo instance Faker

        // Dữ liệu sản phẩm giả cho Laptop và Pre-built PC
        $products = [];
        $laptopAndPrebuiltPCs = [];

        // Thông tin các sản phẩm giả
        $laptops = [
            ['name' => 'Apple MacBook Pro 13" M1', 'cpu' => 'Apple M1', 'ram' => '8GB', 'screen_size' => '13.3', 'battery_life' => '20 hours', 'ssd_size' => '256GB', 'category_id'=>'3'],
            ['name' => 'Dell XPS 13', 'cpu' => 'Intel Core i7-1165G7', 'ram' => '16GB', 'screen_size' => '13.4', 'battery_life' => '12 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'HP Spectre x360', 'cpu' => 'Intel Core i7-1165G7', 'ram' => '16GB', 'screen_size' => '13.3', 'battery_life' => '13 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Asus ZenBook 14', 'cpu' => 'Intel Core i5-1135G7', 'ram' => '8GB', 'screen_size' => '14', 'battery_life' => '10 hours', 'ssd_size' => '256GB', 'category_id'=>'3'],
            ['name' => 'Lenovo ThinkPad X1 Carbon Gen 9', 'cpu' => 'Intel Core i7-1185G7', 'ram' => '16GB', 'screen_size' => '14', 'battery_life' => '15 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Microsoft Surface Laptop 4', 'cpu' => 'Intel Core i7-1165G7', 'ram' => '16GB', 'screen_size' => '13.5', 'battery_life' => '32 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Acer Swift 3', 'cpu' => 'AMD Ryzen 7 5700U', 'ram' => '8GB', 'screen_size' => '14', 'battery_life' => '11 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Razer Blade 15', 'cpu' => 'Intel Core i7-10875H', 'ram' => '16GB', 'screen_size' => '15.6', 'battery_life' => '6 hours', 'ssd_size' => '1TB', 'category_id'=>'2'],
            ['name' => 'Samsung Galaxy Book Pro 360', 'cpu' => 'Intel Core i5-1135G7', 'ram' => '8GB', 'screen_size' => '13.3', 'battery_life' => '15 hours', 'ssd_size' => '256GB', 'category_id'=>'3'],
            ['name' => 'LG Gram 17', 'cpu' => 'Intel Core i7-1165G7', 'ram' => '16GB', 'screen_size' => '17', 'battery_life' => '19 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Asus ROG Zephyrus G14', 'cpu' => 'AMD Ryzen 9 5900HS', 'ram' => '16GB', 'screen_size' => '14', 'battery_life' => '10 hours', 'ssd_size' => '1TB', 'category_id'=>'2'],
            ['name' => 'Dell XPS 13 Plus', 'cpu' => 'Intel Core i7-1260P', 'ram' => '16GB', 'screen_size' => '13.4', 'battery_life' => '12 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'HP Envy 16', 'cpu' => 'Intel Core i7-12700H', 'ram' => '16GB', 'screen_size' => '16', 'battery_life' => '15 hours', 'ssd_size' => '1TB', 'category_id'=>'3'],
            ['name' => 'Lenovo Yoga 7i', 'cpu' => 'Intel Core i5-1235U', 'ram' => '8GB', 'screen_size' => '14', 'battery_life' => '13 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'MacBook Pro 14" M2', 'cpu' => 'Apple M2 Pro', 'ram' => '16GB', 'screen_size' => '14', 'battery_life' => '18 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Samsung Galaxy Book3 Ultra', 'cpu' => 'Intel Core i7-13700H', 'ram' => '16GB', 'screen_size' => '16', 'battery_life' => '19 hours', 'ssd_size' => '1TB', 'category_id'=>'3'],
            ['name' => 'MSI Stealth 17 Studio', 'cpu' => 'Intel Core i9-13900H', 'ram' => '32GB', 'screen_size' => '17.3', 'battery_life' => '6 hours', 'ssd_size' => '2TB', 'category_id'=>'3'],
            ['name' => 'Acer Swift Edge', 'cpu' => 'AMD Ryzen 7 6800U', 'ram' => '16GB', 'screen_size' => '16', 'battery_life' => '14 hours', 'ssd_size' => '512GB', 'category_id'=>'3'],
            ['name' => 'Microsoft Surface Laptop Studio', 'cpu' => 'Intel Core i7-11370H', 'ram' => '16GB', 'screen_size' => '15.6', 'battery_life' => '11 hours', 'ssd_size' => '1TB', 'category_id'=>'1'],
            ['name' => 'Laptop Asus ROG Strix G16 G614JV-N3515W', 'cpu' => 'Core i7-13650HX', 'vga' => 'NVIDIA GeForce RTX™ 4060 8GB GDDR6', 'ram' => '32GB', 'screen_size' => '14', 'battery_life' => '10 hours', 'ssd_size' => '1TB', 'category_id'=> '2'],
            ['name' => 'Dell XPS 13 PlusLaptop Asus Gaming ROG Zephyrus G16 GA605WI-QR156WS', 'cpu' => ' AMD Ryzen™ AI 9 HX 370','vga' => 'NVIDIA GeForce RTX™ 4070 8GB GDDR6', 'ram' => '16GB', 'screen_size' => '13.4', 'battery_life' => '12 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'HP Omen 17', 'cpu' => 'Intel Core i7-12700H', 'ram' => '16GB', 'screen_size' => '17.3', 'battery_life' => '8 hours', 'ssd_size' => '1TB', "category_id" =>"2"],
            ['name' => 'Asus TUF Gaming F15', 'cpu' => 'Intel Core i5-11400H', 'ram' => '8GB', 'screen_size' => '15.6', 'battery_life' => '7 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'Dell Latitude 9420', 'cpu' => 'Intel Core i7-1185G7', 'ram' => '16GB', 'screen_size' => '14', 'battery_life' => '12 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'Lenovo ThinkPad X1 Extreme Gen 4', 'cpu' => 'Intel Core i7-11850H', 'ram' => '32GB', 'screen_size' => '16', 'battery_life' => '9 hours', 'ssd_size' => '1TB', "category_id" =>"2"],
            ['name' => 'Acer Nitro 5', 'cpu' => 'AMD Ryzen 5 5600H', 'ram' => '16GB', 'screen_size' => '15.6', 'battery_life' => '10 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'LG UltraPC 17', 'cpu' => 'Intel Core i7-1260P', 'ram' => '16GB', 'screen_size' => '17', 'battery_life' => '11 hours', 'ssd_size' => '1TB', "category_id" =>"2"],
            ['name' => 'Microsoft Surface Pro X', 'cpu' => 'Microsoft SQ2', 'ram' => '16GB', 'screen_size' => '13', 'battery_life' => '15 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'Samsung Notebook 9 Pro', 'cpu' => 'Intel Core i7-8565U', 'ram' => '16GB', 'screen_size' => '15', 'battery_life' => '10 hours', 'ssd_size' => '256GB', "category_id" =>"2"],
            ['name' => 'Asus Vivobook S14', 'cpu' => 'AMD Ryzen 7 5700U', 'ram' => '8GB', 'screen_size' => '14', 'battery_life' => '12 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'Razer Book 13', 'cpu' => 'Intel Core i5-1135G7', 'ram' => '16GB', 'screen_size' => '13.4', 'battery_life' => '14 hours', 'ssd_size' => '512GB' , "category_id" =>"2"],
            ['name' => 'Alienware m15 R7', 'cpu' => 'Intel Core i7-12700H', 'ram' => '16GB', 'screen_size' => '15.6', 'battery_life' => '6 hours', 'ssd_size' => '1TB', "category_id" =>"2"],
            ['name' => 'HP Victus 16', 'cpu' => 'AMD Ryzen 5 6600H', 'ram' => '8GB', 'screen_size' => '16.1', 'battery_life' => '8 hours', 'ssd_size' => '512GB', "category_id" =>"2"],
            ['name' => 'Dell Inspiron 14 2-in-1', 'cpu' => 'Intel Core i7-1255U', 'ram' => '8GB', 'screen_size' => '14', 'battery_life' => '11 hours', 'ssd_size' => '256GB', "category_id" =>"2"],
            ['name' => 'Gigabyte Aero 16', 'cpu' => 'Intel Core i9-12900HK', 'ram' => '32GB', 'screen_size' => '16', 'battery_life' => '6 hours', 'ssd_size' => '2TB', 'category_id'=> '2'],
            ['name' => 'Lenovo Legion 5i', 'cpu' => 'Intel Core i7-12600H', 'ram' => '16GB', 'screen_size' => '15.6', 'battery_life' => '8 hours', 'ssd_size' => '1TB', 'category_id'=> '2'],
            ['name' => 'Acer Aspire Vero', 'cpu' => 'Intel Core i5-1235U', 'ram' => '8GB', 'screen_size' => '15.6', 'battery_life' => '10 hours', 'ssd_size' => '512GB', 'category_id'=> '2'],
            ['name' => 'MSI Katana GF76', 'cpu' => 'Intel Core i7-11800H', 'ram' => '16GB', 'screen_size' => '17.3', 'battery_life' => '7 hours', 'ssd_size' => '512GB', 'category_id'=> '2'],
            ['name' => 'Huawei MateBook X Pro', 'cpu' => 'Intel Core i7-1260P', 'ram' => '16GB', 'screen_size' => '14.2', 'battery_life' => '11 hours', 'ssd_size' => '1TB', 'category_id'=> '2'],
            ['name' => 'Toshiba Dynabook Portege X30L', 'cpu' => 'Intel Core i5-1135G7', 'ram' => '8GB', 'screen_size' => '13.3', 'battery_life' => '14 hours', 'ssd_size' => '256GB', 'category_id'=> '2'],
            ['name' => 'Asus ZenBook Pro Duo 15', 'cpu' => 'Intel Core i9-11900H', 'ram' => '32GB', 'screen_size' => '15.6', 'battery_life' => '5 hours', 'ssd_size' => '1TB', 'category_id'=> '2'],
            ['name'=> 'Lenovo Legion 5', 'cpu' => "intel core i9-11900H", "vga" => "NVIDIA GeForce RTX 3070", 'ram' => '32GB', 'screen_size' => '15.6', 'battery_life' => '5 hours', 'ssd_size' => '1TB', 'category_id' => '2'],
            ['name'=> 'Asus ROG Strix G15', 'cpu' => "intel core i7-11800H", "vga" => "NVIDIA GeForce RTX 3060", 'ram' => '16GB', 'screen_size' => '15.6', 'battery_life' => '5 hours', 'ssd_size' => '512GB', 'category_id' => '2'],
            ['name'=> 'Laptop MSI Modern 15 H C13M 216VN', 'cpu' => "Intel Core i7-13700H", "vga" => "Intel Iris Xe", 'ram' => '16GB', 'screen_size' => '17.3', 'battery_life' => '7 hours', 'ssd_size' => '512GB', 'category_id' => '2'],
            ['name'=> 'Laptop ASUS TUF Gaming A15 FA507NUR-LP101W ', 'cpu' => "AMD Ryzen 7 7435HS", "vga" => "RTX 4050", 'ram' => '8GB', 'screen_size' => '15.6', 'battery_life' => '10 hours', 'ssd_size' => '512GB', 'category_id' => '2'],
            ['name'=> 'Laptop Dell XPS 14 9440 71054773 OLED', 'cpu' => "intel core i7-12600H", "vga" => "NVIDIA GeForce RTX 3060", 'ram' => '64Gb', 'screen_size' => '14.5', 'battery_life' => '8 hours', 'ssd_size' => '1TB', 'category_id' => '2'],
            ['name'=> 'Laptop Gigabyte G5 KF5-53VN383SH', 'cpu' => "intel core i5-13500H", "vga" => "NVIDIA GeForce RTX 4060 8GB GDDR6", 'ram' => '32GB', 'screen_size' => '16', 'battery_life' => '6 hours', 'ssd_size' => '2TB', 'category_id' => '2'],
            ['name'=> 'Laptop Dell Mobile Precision Workstation 5680 71023332', 'cpu' => "intel core i7-1255U", "vga" => "Intel Iris Xe", 'ram' => '8GB', 'screen_size' => '14', 'battery_life' => '11 hours', 'ssd_size' => '256GB', 'category_id' => '2'],
        ];

        $prebuiltPCs = [
            ['name' => 'CyberPowerPC Gamer Xtreme VR', 'cpu' => 'Intel Core i9-11900KF', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 3080', 'mainboard' => 'MSI Z590-A PRO', 'power_supply' => 'Corsair RM850x', 'cpu_fan' => 'Noctua NH-D15', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id'=> '114'],
            ['name' => 'Alienware Aurora R12', 'cpu' => 'Intel Core i7-11700KF', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 3070', 'mainboard' => 'Alienware Z490', 'power_supply' => 'Corsair RM850x', 'cpu_fan' => 'Corsair iCUE H100i', 'hdd_size' => '2TB', 'ssd_size' => '512GB', 'category_id'=> '113'],
            ['name' => 'HP Omen 30L', 'cpu' => 'Intel Core i9-11900K', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 3070', 'mainboard' => 'MSI Z590-A PRO', 'power_supply' => 'Corsair RM750', 'cpu_fan' => 'Corsair iCUE H115i', 'hdd_size' => '1TB', 'ssd_size' => '1TB', 'category_id'=> '114'],
            ['name' => 'MSI Trident X', 'cpu' => 'Intel Core i7-10700K', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 3080', 'mainboard' => 'MSI Z490 GAMING EDGE WIFI', 'power_supply' => 'EVGA SuperNOVA 750W', 'cpu_fan' => 'Corsair Hydro Series H100i Pro', 'hdd_size' => '2TB', 'ssd_size' => '512GB', 'category_id'=> '114'],
            ['name' => 'Corsair Vengeance i7200', 'cpu' => 'Intel Core i9-11900K', 'ram' => '64GB', 'vga' => 'NVIDIA GeForce RTX 3090', 'mainboard' => 'Corsair iCUE 4000X', 'power_supply' => 'Corsair RM1000x', 'cpu_fan' => 'Corsair iCUE H150i Elite', 'hdd_size' => '2TB', 'ssd_size' => '2TB', 'category_id'=> '114'],
            ['name' => 'Origin PC Millennium', 'cpu' => 'Intel Core i9-10900K', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 3080', 'mainboard' => 'Asus ROG Strix Z490-E', 'power_supply' => 'EVGA SuperNOVA 850W', 'cpu_fan' => 'Noctua NH-D15', 'hdd_size' => '4TB', 'ssd_size' => '1TB', 'category_id'=> '112'],
            ['name' => 'CyberPowerPC Infinity Xtreme', 'cpu' => 'AMD Ryzen 9 5900X', 'ram' => '64GB', 'vga' => 'NVIDIA GeForce RTX 3070', 'mainboard' => 'MSI MEG X570 UNIFY', 'power_supply' => 'Corsair RM850x', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id'=> '113'],
            ['name' => 'Skytech Blaze II', 'cpu' => 'Intel Core i5-11400F', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce GTX 1660 Super', 'mainboard' => 'MSI B460M-A PRO', 'power_supply' => 'EVGA 600 W1', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '500GB', 'category_id'=> '112'],
            ['name' => 'iBUYPOWER Element MR 9320', 'cpu' => 'Intel Core i7-10700F', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 3060', 'mainboard' => 'ASRock B460M PRO4', 'power_supply' => 'Corsair CV650', 'cpu_fan' => 'Corsair iCUE H100i', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id'=> '113'],
            ['name' => 'ABS Gladiator', 'cpu' => 'AMD Ryzen 5 5600X', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce GTX 1660 Ti', 'mainboard' => 'Gigabyte B550M DS3H', 'power_supply' => 'EVGA 600W', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id'=> '112'],
            ['name' => 'PC Gaming AMD Ryzen 7 7800X3D', 'cpu' => 'AMD Ryzen 7 7800X3D', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 4070 Super', 'mainboard' => 'MSI B550-A PRO', 'power_supply' => 'Corsair RM750x', 'cpu_fan' => 'Noctua NH-D15', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id'=> '109'],
            ['name' => 'PC Core I7 14700K', 'cpu' => 'Intel Core i7-14700K', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 4070 Ti Super', 'mainboard' => 'ASUS ROG STRIX Z790-E', 'power_supply' => 'Seasonic Focus GX-850', 'cpu_fan' => 'NZXT Kraken Z73', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id'=> '110'],
            ['name' => 'PC ASUS ROG AI Gaming Master', 'cpu' => 'AMD Ryzen 7 9800X3D', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 4080 Super', 'mainboard' => 'ASUS ROG Crosshair VIII Hero', 'power_supply' => 'Thermaltake Toughpower 850W', 'cpu_fan' => 'Corsair iCUE H150i', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id'=> '110'],
            ['name' => 'PC CORE I7-13700K', 'cpu' => 'Intel Core i7-13700K', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 3060', 'mainboard' => 'Gigabyte Z690 Gaming X', 'power_supply' => 'EVGA SuperNOVA 750W', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id'=> '113'],
            ['name' => 'PC ULTRA 9 285K', 'cpu' => 'Intel Core i9-12900K', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 4080', 'mainboard' => 'MSI MPG Z690 Carbon', 'power_supply' => 'Corsair HX1000', 'cpu_fan' => 'NZXT Kraken X53', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id' => '113'],
            ['name' => 'PC GIGABYTE GAMING A.I', 'cpu' => 'Intel Core i5-12400F', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 4060', 'mainboard' => 'Gigabyte B660M DS3H', 'power_supply' => 'Cooler Master MWE 650', 'cpu_fan' => 'DeepCool GAMMAXX 400', 'hdd_size' => '1TB', 'ssd_size' => '512GB',  'category_id' => '110'],
            ['name' => 'PC MSI GAMING RED DRAGON', 'cpu' => 'AMD Ryzen 5 7600', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 4060', 'mainboard' => 'MSI B550 TOMAHAWK', 'power_supply' => 'Thermaltake Smart 600W', 'cpu_fan' => 'Cooler Master ML240L', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id' => '110'],
            ['name' => 'PC GAMING I5-12400F', 'cpu' => 'Intel Core i5-12400F', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 3060', 'mainboard' => 'ASUS PRIME B660M-A', 'power_supply' => 'Seasonic Focus GX-650', 'cpu_fan' => 'Noctua NH-U12S', 'hdd_size' => '1TB', 'ssd_size' => '256GB', 'category_id' => '110'],
            ['name' => 'PC ASUS TUF A.I Game Master', 'cpu' => 'Intel Core i5-12400F', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 4060 Ti', 'mainboard' => 'ASUS TUF Gaming B660M-PLUS', 'power_supply' => 'Corsair RM750x', 'cpu_fan' => 'NZXT Kraken X53', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id' => '110'],
            ['name' => 'PC CORE I9-13900K', 'cpu' => 'Intel Core i9-13900K', 'ram' => '64GB', 'vga' => 'NVIDIA GeForce RTX 4090', 'mainboard' => 'ASUS ROG STRIX Z790-E', 'power_supply' => 'Corsair HX1200', 'cpu_fan' => 'Corsair iCUE H150i', 'hdd_size' => '4TB', 'ssd_size' => '2TB', 'category_id' => '110'],
            ['name' => 'PC Gaming Beast', 'cpu' => 'AMD Ryzen 9 7950X3D', 'ram' => '64GB', 'vga' => 'NVIDIA GeForce RTX 4090', 'mainboard' => 'ASUS ROG X670E Crosshair', 'power_supply' => 'Seasonic Prime TX-1000', 'cpu_fan' => 'Noctua NH-D15S', 'hdd_size' => '4TB', 'ssd_size' => '2TB', 'category_id' => '110'],
            ['name' => 'PC Advanced Gamer', 'cpu' => 'Intel Core i7-13700KF', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 4080', 'mainboard' => 'MSI Z690 PRO-A', 'power_supply' => 'Cooler Master 850W', 'cpu_fan' => 'NZXT Kraken X62', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id' => '110'],
            ['name' => 'PC Extreme Workstation', 'cpu' => 'Intel Core i9-12900HX', 'ram' => '128GB', 'vga' => 'NVIDIA GeForce RTX 3090 Ti', 'mainboard' => 'Gigabyte Z690 AORUS XTREME', 'power_supply' => 'Corsair AX1600i', 'cpu_fan' => 'Corsair Hydro Series H150i', 'hdd_size' => '8TB', 'ssd_size' => '4TB', 'category_id' => '110'],
            ['name' => 'PC Gaming Intel Core I5-12400F', 'cpu' => 'Intel Core i5-12400F', 'ram' => '16GB', 'vga' => 'NVIDIA GeForce RTX 3060 Ti', 'mainboard' => 'MSI B660M PRO-A', 'power_supply' => 'EVGA 650W', 'cpu_fan' => 'Cooler Master ML240L', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id' => '110'],
            ['name' => 'PC Core I9-13900K', 'cpu' => 'Intel Core i9-13900K', 'ram' => '64GB', 'vga' => 'NVIDIA GeForce RTX 4090', 'mainboard' => 'MSI Z790 Edge', 'power_supply' => 'Corsair HX1200', 'cpu_fan' => 'NZXT Kraken Z63', 'hdd_size' => '6TB', 'ssd_size' => '2TB', 'category_id' => '110'],
            ['name' => 'PC Gaming Ryzen 5 7600X', 'cpu' => 'AMD Ryzen 5 7600X', 'ram' => '16GB', 'vga' => 'AMD Radeon RX 7900 XT', 'mainboard' => 'ASUS TUF Gaming B650M', 'power_supply' => 'Seasonic Focus GX-750', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '512GB', 'category_id' => '110'],
            ['name' => 'PC Ryzen 9 7900X', 'cpu' => 'AMD Ryzen 9 7900X', 'ram' => '32GB', 'vga' => 'NVIDIA GeForce RTX 4080', 'mainboard' => 'MSI MEG B650 Carbon', 'power_supply' => 'Thermaltake Toughpower 850W', 'cpu_fan' => 'Corsair iCUE H150i', 'hdd_size' => '2TB', 'ssd_size' => '1TB', 'category_id' => '114'],
            ['name' => 'PC VĂN PHÒNG 02 (I5 10400/ H510/ 8G/ 240G SSD)', 'cpu' => 'Intel Core i5-10400', 'ram' => '8GB', 'vga' => 'Intel UHD Graphics 630', 'mainboard' => 'ASUS H510M-E', 'power_supply' => 'Cooler Master MWE 450W', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '240GB', 'category_id' => '115'],
            ['name' => 'Bộ PC văn phòng VP03 CPU AMD Ryzen 5 5600G/ RAM 8GB', 'cpu' => 'AMD Ryzen 5 5600G', 'ram' => '8GB', 'mainboard' => 'ASUS H510M-E', 'power_supply' => 'Cooler Master MWE 450W', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '240GB', 'category_id' => '115'],
            ['name' => 'Bộ PC văn phòng VP05 CPU Intel Core I5 14400/ RAM 8GB', 'cpu' => 'Intel Core i5-14400', 'ram' => '8GB', 'mainboard' => 'ASUS H610M-E', 'power_supply' => 'Cooler Master MWE 450W', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '240GB', 'category_id' => '115'],
            ['name' => 'Bộ máy tính văn phòng AMD 4700S (4700S / 16GB / SSD 240GB / RX550)', 'cpu' => 'CPU AMD 4700S', 'ram' => '8GB', 'mainboard' => 'ASUS H510M-E', 'power_supply' => 'Cooler Master MWE 450W', 'cpu_fan' => 'Cooler Master Hyper 212', 'hdd_size' => '1TB', 'ssd_size' => '240GB', 'category_id' => '115'],
        ];


        // Chèn dữ liệu vào bảng products
        foreach ($laptops as $index => $laptop) {
            $discount_type = Arr::random([99, 1, null]);
            if ($discount_type == 1){
                $discount_value = Arr::random([5, 10, 15, 20, 25]);
            } else if ($discount_type == 99){
                $discount_value = $faker->numberBetween(1000000, 3000000);
            } else {
                $discount_value = null;
            }
            $products[] = [
                'name' => $laptop['name'],
                'slug' => Str::slug($laptop['name']),
                'type' => 'LAPTOP',
                'cost' => $faker->numberBetween(15000000, 30000000),
                'price' => $faker->numberBetween(20000000, 35000000),
                'images' => json_encode(['https://laptopspecialists.files.wordpress.com/2014/10/acer-aspire-e1-570-6803-15-6-inch-laptop.jpg', 'https://cdn.thewirecutter.com/wp-content/media/2023/06/bestlaptops-2048px-9765.jpg?auto=webp&quality=75&width=768&dpr=2']),
                'post_id' => $index + 2,
                'category_id' => $laptop['category_id'],
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'detail_id' => $index + 1,
                'quantity' => rand(10,100),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($prebuiltPCs as $index => $pc) {
            $discount_type = Arr::random([99, 1, null]);

            if ($discount_type == 1){
                $discount_value = Arr::random([5, 10, 15, 20, 25]);
            } else if ($discount_type == 99){
                $discount_value = $faker->numberBetween(1000000, 3000000);
            } else {
                $discount_value = null;
            }
            $products[] = [
                'name' => $pc['name'],
                'slug' => Str::slug($pc['name']),
                'type' => 'PC',
                'cost' => $faker->numberBetween(15000000, 35000000),
                'price' => $faker->numberBetween(20000000, 40000000),
                'images' => json_encode([
                    'https://cmscpt.s3.ap-southeast-1.amazonaws.com/250-27018-d0a7c1d9d621707f2930.jpg',
                    'https://cmscpt.s3.ap-southeast-1.amazonaws.com/250-27525-khung-pc.jpg'
                ]),
                'post_id' => $index + 12,
                'quantity' => rand(10,100),
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'category_id' => $pc['category_id'], // Prebuilt PC category
                'detail_id' => $index + 11,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chèn vào bảng laptop_and_prebuilt_pcs
        foreach ($products as $index => $product) {
            if ($product['type'] === 'LAPTOP') {
                $laptop = $laptops[$index];
                $laptopAndPrebuiltPCs[] = [
                    'product_type' => $product['type'],
                    'screen_size' => $laptop['screen_size'],
                    'cpu' => $laptop['cpu'],
                    'ram' => $laptop['ram'],
                    'ram_memory' => 'DDR4',
                    'battery_life' => $laptop['battery_life'],
                    'vga' => null,
                    'mainboard' => null,
                    'power_supply' => null,
                    'cpu_fan' => null,
                    'hdd_size' => null,
                    'ssd_size' => $laptop['ssd_size'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } elseif ($product['type'] === 'PC') {
                $pc = $prebuiltPCs[$index - count($laptops)];
                $laptopAndPrebuiltPCs[] = [
                    'product_type' => $product['type'],
                    'screen_size' => null,
                    'cpu' => $pc['cpu'],
                    'ram' => $pc['ram'],
                    'ram_memory' => 'DDR4',
                    'battery_life' => null,
                    'vga' => $pc['vga'] ?? null,
                    'mainboard' => $pc['mainboard'],
                    'power_supply' => $pc['power_supply'],
                    'cpu_fan' => $pc['cpu_fan'],
                    'hdd_size' => $pc['hdd_size'],
                    'ssd_size' => $pc['ssd_size'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('products')->insert($products);
        DB::table('laptop_and_prebuilt_pcs')->insert($laptopAndPrebuiltPCs);
    }
}

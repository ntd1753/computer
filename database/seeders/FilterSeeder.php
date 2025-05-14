<?php

namespace Database\Seeders;

use App\Models\Filter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas= [
          ['key' => 'CPU', 'value' => json_encode(['Intel Core i5', 'Intel Core i7','Intel Core i9', 'AMD Ryzen 5', 'AMD Ryzen 7', 'Intel Core Xeon'])],
          ['key' => 'RAMSIZE', 'value' => json_encode(['8GB', '16GB', '32GB'])],
          ['key' => 'STORAGE', 'value' => json_encode(['HDD', 'SSD'])],
          ['key' => 'SCREENSIZE', 'value' => json_encode(['13 inch', '15 inch', '17 inch'])],
            ['key' => 'VGA', 'value' => json_encode([ 'RTX 3050',
                'RTX 3060',
                'RTX 3070',
                'RTX 3080',
                'RTX 3090',
                'GTX 1650',
                'GTX 1660 Ti',
                'GTX 1080 Ti',
                'RTX 5000',
                'RX 6700 XT',
                'RX 6900 XT',
                'Intel Arc A770'
            ])],
            ['key' => 'BATTERYLIFE', 'value' => json_encode(['2 hours', '4 hours', '6 hours', '8 hours'])],
            ['key' => 'PSU', 'value' => json_encode(['500W', '600W', '700W'])],
            ['key' => 'CPUFAN', 'value' => json_encode(['Cooler Master', 'Noctua', 'Corsair'])],
            ['key' => 'HHDSIZE', 'value' => json_encode(['1TB', '2TB', '4TB'])],
            ['key' => 'SSDSIZE', 'value' => json_encode(['256GB', '512GB', '1TB'])],
            ['key' => 'RAMTYPE', 'value' => json_encode(['DDR4', 'DDR5'])],
        ];
        foreach ($datas as $data) {
            Filter::create($data);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('payment_methods')->insert([
            [
                'name' => 'COD',
                'info' => 'Thanh toán khi nhận hàng',
            ],
            [
                'name' => 'VNPAY',
                'info' => 'Thanh toán qua VNPAY',
            ],
            [
                'name' => 'MOMO',
                'info' => 'Thanh toán qua MOMO',
            ],
        ]);
    }
}

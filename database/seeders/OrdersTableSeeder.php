<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Số lượng đơn hàng cần tạo
        $numberOfOrders = 100;

        // Lặp qua để tạo dữ liệu
        for ($i = 0; $i < $numberOfOrders; $i++) {
            DB::table('orders')->insert([
                'user_id' => null, // Giả sử có 10 người dùng
                'payment_id' => $faker->numberBetween(1, 2), // Giả sử có 3 phương thức thanh toán
                'total' => $faker->numberBetween(100000, 500000), // Tổng tiền đơn hàng
                'discount' => $faker->numberBetween(0, 50000), // Giảm giá
                'total_amount' => $faker->numberBetween(100000, 500000), // Tổng tiền sau khi giảm giá
                'order_status' => $faker->randomElement(array_keys(Order::$listOrderStatus)), // Trạng thái đơn hàng
                'payment_status' => $faker->randomElement(array_keys(Order::$listPaymentStatus)), // Trạng thái thanh toán
                'customer_name' => $faker->name, // Tên khách hàng
                'customer_email' => $faker->unique()->safeEmail, // Email khách hàng
                'customer_phone' => $faker->phoneNumber, // Số điện thoại khách hàng
                'customer_address' => $faker->address, // Địa chỉ khách hàng
                'created_at' => Carbon::now()->subDays($faker->numberBetween(0, 100)), // Thời gian tạo đơn hàng
            ]);
        }
    }
}


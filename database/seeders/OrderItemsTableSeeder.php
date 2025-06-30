<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $numberOfOrders = 50;  // Tổng số đơn hàng
        $numberOfProducts = 70; // Tổng số sản phẩm

        // Lặp qua để tạo dữ liệu order_items
        for ($i = 0; $i < 200; $i++) {
            $product=Product::find($faker->numberBetween(1, $numberOfProducts));
            $order=DB::table("orders")->find($faker->numberBetween(1, $numberOfProducts));
            DB::table('order_items')->insert([
                'order_id' => $faker->numberBetween(1, $numberOfOrders),
                'product_id' => $product->id,
                'quantity' => $faker->numberBetween(1, 10),
                'price' => $product->price, // Giá sản phẩm
                'created_at' => $order->created_at,
                'updated_at' => $order->created_at,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostCategorySeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(LaptopAndPrebuiltPCSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(FilterSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
    }
}

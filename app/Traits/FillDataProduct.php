<?php

namespace App\Traits;

use App\Models\LaptopAndPrebuiltPc;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Product;

trait FillDataProduct
{
    protected function fillProduct($input, $detailProduct, $post, $product, $productType)
    {
        $product->name = $input['name'];
        $product->slug = $input['slug'] ??Str::slug($input['name']);
        $product->type = $productType;
        $product->cost = $input['cost'];
        $product->price = $input['price'];
        $product->discount_type = $input['discount_type'] ?? null;
        $product->discount_value = $input['discount_value'] ?? null;
        $product->category_id = $input['category_id'];
        $product->brand_id = $input['brand_id'];
        $product->detail_id = $detailProduct->id;
        $product->post_id = $post->id;
        $product->quantity = $input['quantity'] ?? 1;
        $product->is_bestseller = Arr::get($input, 'is_bestseller', 0);
        $product->save();

        return $product;
    }
}

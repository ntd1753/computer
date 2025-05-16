<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use OpenAI\Laravel\Facades\OpenAI;

class GenerateProductEmbeddings extends Command
{
    protected $signature = 'products:generate-embeddings';
    protected $description = 'Tạo embedding cho toàn bộ sản phẩm';

    public function handle()
    {
        $products = Product::whereNull('embedding')->get();

        foreach ($products as $product) {
            $text = "{$product->name}, loại: {$product->type}, giá: {$product->price} VND";

            $embedding = OpenAI::embeddings()->create([
                'model' => 'text-embedding-3-small',
                'input' => $text,
            ])['data'][0]['embedding'];

            $product->embedding = $embedding;
            $product->save();

            $this->info("Đã tạo embedding cho: {$product->name}");
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);

            // Enum type for the 'type' column
            $table->enum('type', ['PC', 'ACCESSORY', 'LAPTOP', 'CUSTOM_PC']);
            $table->bigInteger('cost');
            $table->bigInteger('price');
            $table->bigInteger('discount_type')->nullable();
            $table->bigInteger('discount_value')->nullable();
            $table->unsignedInteger('quantity')->nullable();

            // Images encoded in JSON format
            $table->json('images')->nullable(); // Assuming this will store JSON

            $table->unsignedBigInteger('post_id')->nullable(); // Assuming it's a foreign key
            $table->unsignedBigInteger('category_id')->nullable(); // Assuming it's a foreign key
            $table->unsignedBigInteger('detail_id')->nullable(); // Assuming it's a foreign key

            $table->timestamps();

            // Foreign key constraints (if needed)
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

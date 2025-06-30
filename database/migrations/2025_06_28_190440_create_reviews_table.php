<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính
            $table->unsignedBigInteger('user_id')->nullable(); // Người dùng đánh giá (khóa ngoại từ bảng users)
            $table->unsignedBigInteger('product_id'); // Sản phẩm được đánh giá (khóa ngoại từ bảng products)
            $table->integer('rating')->nullable(); // Đánh giá sao (1 đến 5)
            $table->text('review_content')->nullable(); // Nội dung đánh giá
            $table->string('image_url')->nullable(); // Đường dẫn ảnh đính kèm
            $table->unsignedBigInteger('parent_id')->nullable(); // Cột để lưu trữ câu trả lời (khóa ngoại tự tham chiếu)
            $table->string('status')->nullable();
            $table->timestamps(); // Thời gian tạo và cập nhật

            // Tạo chỉ mục cho cột user_id và product_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Tạo chỉ mục cho cột parent_id
            $table->foreign('parent_id')->references('id')->on('reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

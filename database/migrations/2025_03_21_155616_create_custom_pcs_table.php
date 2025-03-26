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
        Schema::create('custom_pcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('CPU_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('MainBoard_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('RAM_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('SSD_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('HDD_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('VGA_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('PSU_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('Case_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('Fan_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('CPU_Fan_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('AIOFan_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_pcs');
    }
};

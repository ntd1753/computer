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
        Schema::create('rams', function (Blueprint $table) {
            $table->id();
            $table->string('ram_type', 255);  // Cột "ram_type" kiểu string (varchar)
            $table->string('memory_type', 255);  // Cột "memory_type" kiểu string (varchar)
            $table->string('memory_size', 255);  // Cột "memory_size" kiểu string (varchar)
            $table->string('bus', 255);  // Cột "bus" kiểu string (varchar)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rams');
    }
};

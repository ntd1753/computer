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
        Schema::create('laptop_and_prebuilt_pcs', function (Blueprint $table) {
            $table->id();
            $table->string('product_type', 50);
            $table->double('screen_size')->nullable();
            $table->string('cpu', 255);
            $table->string('ram', 50);
            $table->string('ram_memory', 50);
            $table->string('battery_life', 50)->nullable();
            $table->string('vga', 255)->nullable();
            $table->string('mainboard', 255)->nullable();
            $table->string('power_supply', 255)->nullable();
            $table->string('cpu_fan', 255)->nullable();
            $table->string('hdd_size', 50)->nullable();
            $table->string('ssd_size', 50)->nullable();
            $table->longText('data_sheet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptop_and_prebuilt_pcs');
    }
};

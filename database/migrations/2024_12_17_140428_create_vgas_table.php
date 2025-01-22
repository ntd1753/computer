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
        Schema::create('vgas', function (Blueprint $table) {
            $table->id();
            $table->string('vga_series');
            $table->string('memory_type');
            $table->string('memory_size');
            $table->text('inteface');
            $table->text('export_port');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vgas');
    }
};

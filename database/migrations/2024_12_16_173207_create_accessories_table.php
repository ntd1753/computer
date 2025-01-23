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
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();  // Tạo cột "id" (bigInt, auto-increment, primary key)
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['CPU', 'RAM', 'STORAGE', 'PSU', 'CASE', 'MainBoard', 'FAN', 'VGA'])
                ->comment('Type of accessory component');  // Enum cho cột "type"
            $table->foreignId('detail_id');
            $table->text('dataSheet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessories');
    }
};

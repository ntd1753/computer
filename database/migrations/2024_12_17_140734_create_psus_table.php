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
        Schema::create('psus', function (Blueprint $table) {
            $table->id();
            $table->string('power_output'); // công suất
            $table->string('power_standard'); //Chuển ngồn
            $table->string('connector_type'); //kiểu dây kết nối
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('psus');
    }
};

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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sn_id')->unique();
            $table->string('chassis_no')->nullable();
            $table->string('plate_no')->nullable();
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->boolean('expired')->default(false);
            $table->bigInteger('vehicle_test_center_id')->nullable();
            $table->string('vehicle_make_en')->nullable();
            $table->string('vehicle_make_ar')->nullable();
            $table->string('vehicle_model_en')->nullable();
            $table->string('vehicle_model_ar')->nullable();
            $table->bigInteger('service_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};

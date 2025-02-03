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
        Schema::create('vehicle_test_centers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('test_center_id')->nullable();
            $table->string('city_en')->nullable();
            $table->string('city_ar')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('vehicle_test_partner_id')->nullable();
            $table->boolean('supportDangerMaterials')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_test_centers');
    }
};

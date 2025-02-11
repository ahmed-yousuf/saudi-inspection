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
        Schema::create('vehicle_test_partners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('test_partner_id')->nullable()->unique();
            $table->string('partner_en')->nullable();
            $table->string('partner_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_test_partners');
    }
};

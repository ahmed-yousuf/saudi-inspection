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
        Schema::create('vin_data_counters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('start')->default(2300000005); // start counter
            $table->bigInteger('end')->default(500); // end counter
            $table->bigInteger('sn_total')->default(2301105968); // serial number counter
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vin_data_counters');
    }
};

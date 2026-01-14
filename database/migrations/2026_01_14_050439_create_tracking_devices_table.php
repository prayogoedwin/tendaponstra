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
        Schema::create('tracking_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->string('lat');
            $table->string('lng');
            $table->string('batt');
            $table->string('obj_dist');
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_devices');
    }
};

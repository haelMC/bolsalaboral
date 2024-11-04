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
        Schema::create('monitoringdetails', function (Blueprint $table) {
            $table->id();
            $table->string('recommendation');
            $table->string('description');
            $table->date('date_monitoring');
            $table->unsignedBigInteger('monitoring_id');
            $table->foreign('monitoring_id')->references('id')->on('monitorings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoringdetails');
    }
};

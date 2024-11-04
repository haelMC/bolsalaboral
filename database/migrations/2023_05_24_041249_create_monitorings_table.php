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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('joboffer_id');
            $table->unsignedBigInteger('graduate_id');
            $table->unsignedBigInteger('teacher_id');
            // $table->foreign('joboffer_id')->references('id')->on('joboffers')->onDelete('cascade');
            $table->foreign('graduate_id')->references('id')->on('graduates')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};

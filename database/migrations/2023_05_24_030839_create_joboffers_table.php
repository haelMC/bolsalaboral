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
    Schema::create('joboffers', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('type');
        $table->string('location');
        $table->decimal('salary', 10, 2);
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->string('experience_required');
        $table->string('contact_details');
        $table->string('status');
        
        // Nuevo campo para relacionar el trabajo con el usuario (empresa) que lo creó
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->unsignedBigInteger('category_id');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joboffers');
    }
};

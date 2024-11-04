<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->string('cv')->nullable(); // Agregar esta línea para la columna cv
            $table->integer('score')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->nullable();
            $table->unsignedBigInteger('graduate_id')->nullable();
            $table->unsignedBigInteger('joboffer_id')->nullable();
            $table->foreign('graduate_id')->references('id')->on('graduates')->onDelete('cascade')->nullable();
            $table->foreign('joboffer_id')->references('id')->on('joboffers')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postulations');
    }
}

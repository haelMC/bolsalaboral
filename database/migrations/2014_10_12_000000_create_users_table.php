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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('paternal_last_name');
            $table->string('maternal_last_name');
            $table->string('dni', 8)->unique();
            $table->enum('civil_status', ['soltero', 'casado', 'divorciado', 'viudo'])->default('soltero');
            $table->date('birth_date');
            $table->enum('gender', ['masculino', 'femenino', 'otro'])->nullable();
            $table->string('phone');
            $table->tinyInteger('status')->default(0); // 0 = inactivo, 1 = usuario, 2 = empresa
            $table->unsignedBigInteger('role_id')->nullable(); // Clave foránea a la tabla roles
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null'); // Relación con roles
            $table->string('email_reference')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

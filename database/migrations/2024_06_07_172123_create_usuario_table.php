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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('pk_usuario'); // Primary key with auto-increment
            $table->string('correo', 50)->unique(); // VARCHAR(50) NOT NULL, unique
            $table->string('contraseña', 100); // VARCHAR(100) NOT NULL
            $table->integer('estatus'); // INT NOT NULL
            $table->unsignedBigInteger('fk_persona'); // INT NOT NULL, foreign key
            $table->unsignedBigInteger('fk_tipo_usuario'); // INT NOT NULL, foreign key
            $table->timestamps(); // Created_at and updated_at columns

            // Foreign key constraints (assuming the referenced tables exist)
            $table->foreign('fk_persona')->references('pk_persona')->on('persona');
            $table->foreign('fk_tipo_usuario')->references('pk_tipo_usuario')->on('tipo_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};

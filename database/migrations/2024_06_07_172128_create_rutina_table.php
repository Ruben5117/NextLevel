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
        Schema::create('rutina', function (Blueprint $table) {
            $table->id('pk_rutina')->autoIncrement(); // Primary key with auto-increment
            $table->string('nombre', 50); // VARCHAR(50) NOT NULL
            $table->text('descripción'); // TEXT NOT NULL
            $table->string('foto')->nullable(); // VARCHAR NULL
            $table->integer('estatus'); // INT NOT NULL
            $table->date('fecha'); // DATE NOT NULL
            $table->unsignedBigInteger('fk_cliente'); // INT NOT NULL, foreign key
            $table->unsignedBigInteger('fk_comentario'); // INT NOT NULL, foreign key
            $table->unsignedBigInteger('fk_coach'); // INT NOT NULL, foreign key
            $table->timestamps(); // Created_at and updated_at columns

            // Foreign key constraints (assuming the referenced tables exist)
            $table->foreign('fk_cliente')->references('pk_cliente')->on('cliente');
            $table->foreign('fk_comentario')->references('pk_comentario')->on('comentario');
            $table->foreign('fk_coach')->references('pk_coach')->on('coach');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutina');
    }
};

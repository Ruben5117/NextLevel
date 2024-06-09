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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('pk_cliente')->autoIncrement(); // Primary key with auto-increment
            $table->string('cod_cliente', 10); // VARCHAR(10) NOT NULL
            $table->integer('estatus'); // INT NOT NULL
            $table->string('foto', 300)->nullable(); // VARCHAR(300) NULL
            $table->unsignedBigInteger('fk_usuario'); // INT NOT NULL, foreign key
            $table->timestamps(); // Created_at and updated_at columns

            // Foreign key constraint (assuming the referenced table exists)
            $table->foreign('fk_usuario')->references('pk_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};

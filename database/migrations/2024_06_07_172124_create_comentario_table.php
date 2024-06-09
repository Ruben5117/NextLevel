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
        Schema::create('comentario', function (Blueprint $table) {
            $table->id('pk_comentario')->autoIncrement(); // Primary key with auto-increment
            $table->text('comentario'); // TEXT NOT NULL
            $table->integer('estatus'); // INT NOT NULL
            $table->dateTime('fecha'); // DATETIME NOT NULL
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario');
    }
};

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
        Schema::create('medida', function (Blueprint $table) {
            $table->id('pk_medidas')->autoIncrement(); // Primary key with auto-increment
            $table->decimal('peso', 16, 2); // DECIMAL(16,2) NOT NULL
            $table->decimal('estatura', 16, 2); // DECIMAL(16,2) NOT NULL
            $table->date('fecha'); // DATE NOT NULL
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
        Schema::dropIfExists('medida');
    }
};

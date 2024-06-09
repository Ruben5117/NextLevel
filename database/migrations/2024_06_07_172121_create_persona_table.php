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
        Schema::create('persona', function (Blueprint $table) {
            $table->id('pk_persona')->autoIncrement(); // Primary key with auto-increment
            $table->string('nombre', 50); // VARCHAR(50) NOT NULL
            $table->date('fnac'); // DATE NOT NULL
            $table->string('apellidop', 30); // VARCHAR(30) NOT NULL
            $table->string('apellidom', 30); // VARCHAR(30) NOT NULL
            $table->integer('estatus')->nullable(); // INT, can be NULL
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};

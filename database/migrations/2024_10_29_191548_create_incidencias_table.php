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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8);
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('archivo')->nullable(); // Ruta del archivo JPG
            $table->string('laboratorio'); // Ejemplo: "lab1", "lab2"
            $table->string('estado'); // estado
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};

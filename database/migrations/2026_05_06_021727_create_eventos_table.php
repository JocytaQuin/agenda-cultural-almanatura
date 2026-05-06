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
        Schema::create('eventos', function (Blueprint $table) {
    $table->id();

    $table->string('nombre');

    $table->date('fecha');

    $table->time('hora')->nullable();

    $table->string('lugar');

    $table->text('descripcion');

    $table->string('imagen')->nullable();

    $table->string('tipo_actividad')->nullable();

    $table->enum('estado', ['activo', 'pasado'])
          ->default('activo');

    $table->string('google_sheet_url')->nullable();

    $table->text('resumen_posterior')->nullable();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};

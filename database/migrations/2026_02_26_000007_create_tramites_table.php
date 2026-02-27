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
        Schema::create('TRAMITES', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('AREAS');
            $table->foreignId('ubicacion_id')->constrained('UBICACIONES');
            $table->string('nombre_proceso', 255);
            $table->string('dirigido_a', 255)->nullable();
            $table->boolean('requiere_formatos')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps(); // creates created_at and updated_at

            $table->index('area_id', 'idx_tramites_area_id');
            $table->index('ubicacion_id', 'idx_tramites_ubicacion_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TRAMITES');
    }
};

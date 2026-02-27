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
        Schema::create('UBICACIONES', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion_fisica', 255);
            $table->string('referencia_piso_modulo', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UBICACIONES');
    }
};

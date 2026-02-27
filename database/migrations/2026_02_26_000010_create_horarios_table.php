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
        Schema::create('HORARIOS', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')->nullable()->constrained('TRAMITES')->onDelete('cascade');
            $table->string('descripcion', 255);
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->index('tramite_id', 'idx_horarios_tramite_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('HORARIOS');
    }
};

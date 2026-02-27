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
        Schema::create('INTENCIONES', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')->nullable()->constrained('TRAMITES')->onDelete('cascade');
            $table->string('titulo', 150);
            $table->text('respuesta_sugerida');
            $table->boolean('activo')->default(true);

            $table->index('tramite_id', 'idx_intenciones_tramite_id');
            // Fulltext index requires a raw statement in some Laravel versions or specific driver support
            // Schema blueprint supports it as well:
            $table->fullText('respuesta_sugerida', 'ft_respuesta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('INTENCIONES');
    }
};

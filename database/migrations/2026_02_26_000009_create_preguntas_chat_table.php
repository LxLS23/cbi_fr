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
        Schema::create('PREGUNTAS_CHAT', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intencion_id')->constrained('INTENCIONES')->onDelete('cascade');
            $table->text('pregunta');
            $table->json('keywords')->nullable();
            $table->boolean('activo')->default(true);

            $table->index('intencion_id', 'idx_preguntas_intencion_id');
            $table->fullText('pregunta', 'ft_pregunta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PREGUNTAS_CHAT');
    }
};

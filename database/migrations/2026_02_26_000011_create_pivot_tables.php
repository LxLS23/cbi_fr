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
        Schema::create('DOCUMENTOS_TRAMITE', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')->constrained('TRAMITES')->onDelete('cascade');
            $table->foreignId('documento_id')->constrained('DOCUMENTOS')->onDelete('cascade');

            $table->unique(['tramite_id', 'documento_id'], 'idx_dt_unique');
            $table->index('tramite_id', 'idx_dt_tramite');
            $table->index('documento_id', 'idx_dt_documento');
        });

        Schema::create('MEDIO_TRAMITE', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')->constrained('TRAMITES')->onDelete('cascade');
            $table->foreignId('medio_id')->constrained('MEDIOS_DIFUSION')->onDelete('cascade');

            $table->unique(['tramite_id', 'medio_id'], 'idx_mt_unique');
            $table->index('tramite_id', 'idx_mt_tramite');
            $table->index('medio_id', 'idx_mt_medio');
        });

        Schema::create('CANAL_TRAMITE', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')->constrained('TRAMITES')->onDelete('cascade');
            $table->foreignId('canal_id')->constrained('CANALES_CONTACTO')->onDelete('cascade');

            $table->unique(['tramite_id', 'canal_id'], 'idx_ct_unique');
            $table->index('tramite_id', 'idx_ct_tramite');
            $table->index('canal_id', 'idx_ct_canal');
        });

        Schema::create('TRAMITE_HORARIO', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')->constrained('TRAMITES')->onDelete('cascade');
            $table->foreignId('horario_id')->constrained('HORARIOS')->onDelete('cascade');

            $table->unique(['tramite_id', 'horario_id'], 'idx_th_unique');
            $table->index('tramite_id', 'idx_th_tramite');
            $table->index('horario_id', 'idx_th_horario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TRAMITE_HORARIO');
        Schema::dropIfExists('CANAL_TRAMITE');
        Schema::dropIfExists('MEDIO_TRAMITE');
        Schema::dropIfExists('DOCUMENTOS_TRAMITE');
    }
};

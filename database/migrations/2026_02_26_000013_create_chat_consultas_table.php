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
        Schema::create('CHAT_CONSULTAS', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 191);
            $table->foreignId('area_id')->nullable()->constrained('AREAS')->onDelete('set null');
            $table->foreignId('tramite_id')->nullable()->constrained('TRAMITES')->onDelete('set null');
            $table->foreignId('intencion_id')->nullable()->constrained('INTENCIONES')->onDelete('set null');
            $table->text('pregunta');
            $table->string('origen', 50)->default('chatbot');
            $table->timestamp('created_at')->useCurrent();

            $table->index('created_at', 'idx_cc_fecha');
            $table->index('area_id', 'idx_cc_area');
            $table->index('tramite_id', 'idx_cc_tramite');
            $table->index('intencion_id', 'idx_cc_intencion');
            $table->index('session_id', 'idx_cc_session');
            $table->index(['intencion_id', 'created_at'], 'idx_cc_intencion_fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CHAT_CONSULTAS');
    }
};

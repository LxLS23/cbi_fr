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
        Schema::create('CHAT_CONTEXTOS', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 191)->unique();
            $table->foreignId('tramite_id')->nullable()->constrained('TRAMITES')->onDelete('set null');
            $table->foreignId('intencion_id')->nullable()->constrained('INTENCIONES')->onDelete('set null');
            $table->text('last_message')->nullable();
            $table->dateTime('last_interaction_at')->useCurrent();
            $table->timestamps(); // created_at and updated_at

            $table->index('session_id', 'idx_contexto_session');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CHAT_CONTEXTOS');
    }
};

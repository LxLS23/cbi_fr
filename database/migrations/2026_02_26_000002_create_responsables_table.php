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
        Schema::create('RESPONSABLES', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('AREAS')->onDelete('cascade');
            $table->string('nombre', 150);
            $table->string('puesto', 150)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('telefono', 50)->nullable();

            $table->index('area_id', 'idx_responsables_area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RESPONSABLES');
    }
};

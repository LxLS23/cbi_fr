<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Intencion extends Model
{
    /** @use HasFactory<\Database\Factories\IntencionFactory> */
    use HasFactory;

    protected $table = 'INTENCIONES';

    public $timestamps = false; // No timestamps in SQL schema for this table

    protected $fillable = [
        'tramite_id',
        'titulo',
        'respuesta_sugerida',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Get the tramite that owns the intencion.
     */
    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }

    /**
     * Get the questions for the intencion.
     */
    public function preguntas(): HasMany
    {
        return $this->hasMany(PreguntaChat::class, 'intencion_id');
    }

    /**
     * Get the chatbot contexts associated with this intencion.
     */
    public function contextos(): HasMany
    {
        return $this->hasMany(ChatContexto::class, 'intencion_id');
    }

    /**
     * Get the analytics queries associated with this intencion.
     */
    public function consultas(): HasMany
    {
        return $this->hasMany(ChatConsulta::class, 'intencion_id');
    }
}

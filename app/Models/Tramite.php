<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tramite extends Model
{
    /** @use HasFactory<\Database\Factories\TramiteFactory> */
    use HasFactory;

    protected $table = 'TRAMITES';

    protected $fillable = [
        'area_id',
        'ubicacion_id',
        'nombre_proceso',
        'dirigido_a',
        'requiere_formatos',
        'activo',
    ];

    protected $casts = [
        'requiere_formatos' => 'boolean',
        'activo' => 'boolean',
    ];

    /**
     * Get the area that owns the tramite.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Get the location associated with the tramite.
     */
    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    /**
     * The documentos that belong to the tramite.
     */
    public function documentos(): BelongsToMany
    {
        return $this->belongsToMany(Documento::class, 'DOCUMENTOS_TRAMITE', 'tramite_id', 'documento_id');
    }

    /**
     * The medios that belong to the tramite.
     */
    public function medios(): BelongsToMany
    {
        return $this->belongsToMany(MedioDifusion::class, 'MEDIO_TRAMITE', 'tramite_id', 'medio_id');
    }

    /**
     * The canales that belong to the tramite.
     */
    public function canales(): BelongsToMany
    {
        return $this->belongsToMany(CanalContacto::class, 'CANAL_TRAMITE', 'tramite_id', 'canal_id');
    }

    /**
     * Get the intenciones for the tramite.
     */
    public function intenciones(): HasMany
    {
        return $this->hasMany(Intencion::class, 'tramite_id');
    }

    /**
     * Get the horarios for the tramite.
     */
    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class, 'tramite_id');
    }

    /**
     * Get the chatbot contexts associated with the tramite.
     */
    public function contextos(): HasMany
    {
        return $this->hasMany(ChatContexto::class, 'tramite_id');
    }

    /**
     * Get the analytics queries associated with the tramite.
     */
    public function consultas(): HasMany
    {
        return $this->hasMany(ChatConsulta::class, 'tramite_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Horario extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioFactory> */
    use HasFactory;

    protected $table = 'HORARIOS';

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'hora_inicio',
        'hora_fin',
    ];

    /**
     * The tramites that belong to the horario.
     */
    public function tramites(): BelongsToMany
    {
        return $this->belongsToMany(Tramite::class , 'TRAMITE_HORARIO', 'horario_id', 'tramite_id');
    }
}

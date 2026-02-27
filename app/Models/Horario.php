<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horario extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioFactory> */
    use HasFactory;

    protected $table = 'HORARIOS';

    public $timestamps = false;

    protected $fillable = [
        'tramite_id',
        'descripcion',
        'hora_inicio',
        'hora_fin',
    ];

    /**
     * Get the tramite that owns the horario.
     */
    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }
}

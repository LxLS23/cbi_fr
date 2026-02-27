<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    /** @use HasFactory<\Database\Factories\UbicacionFactory> */
    use HasFactory;

    protected $table = 'UBICACIONES';

    public $timestamps = false;

    protected $fillable = [
        'ubicacion_fisica',
        'referencia_piso_modulo',
    ];

    /**
     * Get the tramites for the location.
     */
    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class, 'ubicacion_id');
    }
}

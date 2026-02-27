<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory;

    protected $table = 'AREAS';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Get the responsables for the area.
     */
    public function responsables(): HasMany
    {
        return $this->hasMany(Responsable::class, 'area_id');
    }

    /**
     * Get the tramites for the area.
     */
    public function tramites(): HasMany
    {
        return $this->hasMany(Tramite::class, 'area_id');
    }

    /**
     * Get the consultas for the area.
     */
    public function consultas(): HasMany
    {
        return $this->hasMany(ChatConsulta::class, 'area_id');
    }
}

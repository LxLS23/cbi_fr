<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Responsable extends Model
{
    /** @use HasFactory<\Database\Factories\ResponsableFactory> */
    use HasFactory;

    protected $table = 'RESPONSABLES';

    public $timestamps = false;

    protected $fillable = [
        'area_id',
        'nombre',
        'puesto',
        'correo',
        'telefono',
    ];

    /**
     * Get the area that owns the responsable.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}

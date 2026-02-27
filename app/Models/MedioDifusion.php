<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MedioDifusion extends Model
{
    /** @use HasFactory<\Database\Factories\MedioDifusionFactory> */
    use HasFactory;

    protected $table = 'MEDIOS_DIFUSION';

    public $timestamps = false;

    protected $fillable = [
        'medio',
        'url',
    ];

    /**
     * The tramites that belong to the diffusion medium.
     */
    public function tramites(): BelongsToMany
    {
        return $this->belongsToMany(Tramite::class, 'MEDIO_TRAMITE', 'medio_id', 'tramite_id');
    }
}

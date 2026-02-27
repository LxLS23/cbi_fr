<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CanalContacto extends Model
{
    /** @use HasFactory<\Database\Factories\CanalContactoFactory> */
    use HasFactory;

    protected $table = 'CANALES_CONTACTO';

    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'valor',
    ];

    /**
     * The tramites that belong to the contact channel.
     */
    public function tramites(): BelongsToMany
    {
        return $this->belongsToMany(Tramite::class, 'CANAL_TRAMITE', 'canal_id', 'tramite_id');
    }
}

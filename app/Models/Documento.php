<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Documento extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentoFactory> */
    use HasFactory;

    protected $table = 'DOCUMENTOS';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * The tramites that belong to the document.
     */
    public function tramites(): BelongsToMany
    {
        return $this->belongsToMany(Tramite::class, 'DOCUMENTOS_TRAMITE', 'documento_id', 'tramite_id');
    }
}

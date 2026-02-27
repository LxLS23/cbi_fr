<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreguntaChat extends Model
{
    /** @use HasFactory<\Database\Factories\PreguntaChatFactory> */
    use HasFactory;

    protected $table = 'PREGUNTAS_CHAT';

    public $timestamps = false;

    protected $fillable = [
        'intencion_id',
        'pregunta',
        'keywords',
        'activo',
    ];

    protected $casts = [
        'keywords' => 'array',
        'activo' => 'boolean',
    ];

    /**
     * Get the intencion that owns the question.
     */
    public function intencion(): BelongsTo
    {
        return $this->belongsTo(Intencion::class, 'intencion_id');
    }
}

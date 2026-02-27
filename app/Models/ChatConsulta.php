<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatConsulta extends Model
{
    /** @use HasFactory<\Database\Factories\ChatConsultaFactory> */
    use HasFactory;

    protected $table = 'CHAT_CONSULTAS';

    public $timestamps = false; // Only created_at in schema

    protected $fillable = [
        'session_id',
        'area_id',
        'tramite_id',
        'intencion_id',
        'pregunta',
        'origen',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the area associated with the query.
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Get the tramite associated with the query.
     */
    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }

    /**
     * Get the intencion associated with the query.
     */
    public function intencion(): BelongsTo
    {
        return $this->belongsTo(Intencion::class, 'intencion_id');
    }
}

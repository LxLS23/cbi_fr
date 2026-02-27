<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatContexto extends Model
{
    /** @use HasFactory<\Database\Factories\ChatContextoFactory> */
    use HasFactory;

    protected $table = 'CHAT_CONTEXTOS';

    protected $fillable = [
        'session_id',
        'tramite_id',
        'intencion_id',
        'last_message',
        'last_interaction_at',
    ];

    protected $casts = [
        'last_interaction_at' => 'datetime',
    ];

    /**
     * Get the tramite associated with the context.
     */
    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }

    /**
     * Get the intencion associated with the context.
     */
    public function intencion(): BelongsTo
    {
        return $this->belongsTo(Intencion::class, 'intencion_id');
    }
}

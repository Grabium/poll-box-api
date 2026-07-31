<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable; 
use Illuminate\Database\Eloquent\Relations\Pivot;//Pivot é subclasse de Illuminate\Database\Eloquent\Model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'poll_id',])]
class PendingVote extends Pivot
{
    /** @use HasFactory<GroupUserFactory> */
    use HasFactory;
    
    protected $table = 'pending_votes';

    // Desativa o auto-incremento pois usaremos chave primária composta
    public $incrementing = false;

    // Relacionamento de volta para o Usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento de volta para a Enquete
    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne};

#[Fillable(['group_id',
            'is_active',
            'name',
            'question',
            'pending_users_visibility', 
            'dead_line',
        ])]
class Poll extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean', // Garante o tipo bool no PHP
            'pending_users_visibility' => 'boolean',
            'dead_line' => 'datetime',
        ];
    }

    
    public function group(): BelongsTo
    {
        return $this->belongsTo(
            Group::class,     // 1. Model relacionada
            'group_id',       // 2. Chave estrangeira (FK) na tabela 'polls'
            'id'              // 3. Chave primária (Owner Key) na tabela 'groups' (Opcional se for 'id')           
        );
        // )->withTimestamps();
    }

    /**
     * O snapshot histórico desta enquete (se já encerrada/desativada).
     */
    public function historical(): HasOne
    {
        return $this->hasOne(PollHistorical::class);
    }

}

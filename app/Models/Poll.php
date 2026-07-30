<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['group_id', 'description', 'pending_users_visibility', 'dead_line'])]
class Poll extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    
    public function group(): BelongsTo
    {
        return $this->belongsTo(
            Group::class,     // 1. Model relacionada
            'group_id',       // 2. Chave estrangeira (FK) na tabela 'polls'
            'id'              // 3. Chave primária (Owner Key) na tabela 'groups' (Opcional se for 'id')           
        )->withTimestamps();
    }

}

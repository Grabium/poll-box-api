<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['manager_id', 'description'])]
class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;    

    public function manager(): BelongsTo
    {
        return $this->belongsTo(
            User::class,     // 1. Model relacionada
            'manager_id',    // 2. Chave estrangeira (FK) na tabela 'groups'
            'id'             // 3. Chave primária (Owner Key) na tabela 'users' (Opcional se for 'id')
        );
    }
}
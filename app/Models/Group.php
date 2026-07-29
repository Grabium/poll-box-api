<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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


    /**
     * Relação de usuários pertencentes ao grupo.
     * $group = Group::findOrFail(20);
     * $group->users (Propriedade Dinâmica): Retorna a Coleção de usuários pronta para uso em memória.
     * 
     * $group->users() (Método/Query Builder): Retorna a Relação em si,
     * permitindo encadear novos filtros SQL antes de buscar
     * (ex: $group->users()->where('active', true)->get()).
     * 
     * ====== outro caso =======
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,     // 1. Model relacionada
        )->withTimestamps();
    }
}
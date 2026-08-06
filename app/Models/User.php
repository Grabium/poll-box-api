<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\{Fillable, Hidden};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsToMany, BelongsTo};

#[Fillable(['name', 'email', 'password', 'enterprise_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * $adm = User::(1);// retorna o usuário administrador.
     * $adm->managedGroups;//retorna grupos administrados por ele.
     * $adm->managedGroups();//retorna o objeto que representa a relação (HasMany).
     * $adm->managedGroups()->get();//retorna grupos administrados por ele.
     * 
     * 
     * 
     * 
     * Relacionamento 1:N - Grupos que o usuário GERENCIA.
     */
    public function managedGroups(): HasMany
    {
        return $this->hasMany(
            Group::class,   // 1. Model relacionada (Target Model)
            'manager_id',   // 2. Chave estrangeira (Foreign Key) na tabela 'groups'
            'id'            // 3. Chave local (Local Key) na tabela 'users'
        );
    }

    /**
     * $user->groups é diferente de $user->groups().
     * o 1º tras os dados dos grupos relacionados ao usuários.
     * o 2º tras a relação (o SQL code) e habilita novos processamentos em cima disso. Exemplos abaixo.
     * 
     * Relação de grupos aos quais o usuário pertence.
     *
     * $user->groups possui resultado igual a $user->groups()->get().
     * 
     * Associa o Usuário ID 1 ao Grupo ID 20
     * $user->groups()->attach(20);
     * 
     * Se a pivot tiver campos adicionais (ex: 'status'), passe no segundo argumento:
     * $user->groups()->attach(20, ['status' => 'active']);
     * 
     * recarregue a relação antes de solicitar o estado do objeto no mesmo processo, pois estará desatualizado:
     * $user->load('groups')->groups
     * 
     * 
     * Relacionamento N:N - Grupos dos quais o usuário é MEMBRO.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)
                    ->withTimestamps(); // Mapeia os timestamps da tabela pivot
    }

    /****
     * Relacionamento N:1 - Empresa a qual o usuário PERTENCE.
     */
    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class);
                    //->withTimestamps();// Mapeia os timestamps da tabela pivot
    }
}

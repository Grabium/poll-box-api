<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable; 
use Illuminate\Database\Eloquent\Relations\Pivot;//Pivot é subclasse de Illuminate\Database\Eloquent\Model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



/***
 * Sobre Pivot:
 * 
 * Presume chaves primárias compostas (ex: ['user_id', 'group_id']). Não espera a coluna id por padrão.
 * O método save() e delete() executa queries usando a combinação das chaves estrangeiras como cláusula WHERE.
 * Sabe quais modelos a originaram e armazena os nomes das chaves estrangeiras ($foreignKey, $relatedKey).
 */
#[Fillable(['user_id', 'group_id',])]
class GroupUser extends Pivot //sobrescreve a mecânica interna de persistência e chaves primárias.
{
    /** @use HasFactory<GroupUserFactory> */
    use HasFactory;

    // 1. Nome explícito da tabela pivot
    protected $table = 'group_user';

    // 2. Se sua tabela tiver timestamps na pivot
    public $timestamps = true;

}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{GroupUser, User, Group, Enterprise};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Factories\Helpers\HelperResoucersFactories;

/**
 * @extends Factory<GroupUser>
 */
class GroupUserFactory extends Factory
{
    //trait
    use HelperResoucersFactories;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * O nome da model correspondente.
     */
    protected $model = GroupUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Criando um usuário gerente (de grupo) e um usuário comum na mesma empresa.
        $enterprise_id = Enterprise::factory()->create()->id;
        $manager_id = User::factory()->create(['enterprise_id' => $enterprise_id])->id;
        $memberUser_id = User::factory()->create(['enterprise_id' => $enterprise_id])->id;

        //criando o grupo dentro dessa empresa que comporta os usuários
        $group = Group::factory()->create(['manager_id' => $manager_id,]);
        
        // Mantém os usuários anteriores intocados e não os duplica caso já exista
        $group->users()->syncWithoutDetaching($manager_id);// Aqui pode-se inserir o gerente 

        /***
         * Usuários membros comuns não podem ser sincronizados no grupo aqui.
         * Caso isso ocorra aqui: 
         * $group->users()->syncWithoutDetaching($memberUser_id); 
         * o Seeder tentará inserir o mesmo registro, causando erro por duplicação de registro na faze seguinte.
         */

        return [
            'user_id' => $memberUser_id,
            'group_id' => $group->id,
        ];
    }
}

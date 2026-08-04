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
        $enterprise_id = Enterprise::factory()->create()->id;
        $manager_id = User::factory()->create(['enterprise_id' => $enterprise_id])->id;
        $memberUser_id = User::factory()->create(['enterprise_id' => $enterprise_id])->id;       
        $group = Group::factory()->create(['manager_id' => $manager_id,]);
        
        //Adiciionando o gerente do grupo. O memmbro deve ser passado no retorno desta função.
        // Mantém os usuários anteriores intocados e não os duplica caso já exista
        $group->users()->syncWithoutDetaching($manager_id);     

        // Terá mesmo efeito que: $group->users()->syncWithoutDetaching($memberUser->id);
        return [
            'user_id' => $memberUser->id,
            'group_id' => $group->id,
        ];
    }
}

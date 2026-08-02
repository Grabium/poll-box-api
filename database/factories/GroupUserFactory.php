<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{GroupUser, User, Group, Enterprise};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<GroupUser>
 */
class GroupUserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * O nome da model correspondente.
     */
    protected $model = GroupUser::class;

    /***
     * Função auxiliar
     */
    private function createAnUser(int $enterprise_id): User
    {
        return User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),//Não mudar. DB foi semeado.
            'remember_token' => Str::random(10),
            'enterprise_id' => $enterprise_id,
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enterprise_id = (Enterprise::inRandomOrder()->value('id') ?? Enterprise::factory()->create()->id);

        $manager = $this->createAnUser($enterprise_id);
        $memberUser = $this->createAnUser($enterprise_id);        

        $group = Group::create([
            'manager_id' => $manager->id,
            'description' => fake()->text(20),
        ]);
        
        //Adiciionando o gerente do grupo. O memmbro deve ser passado no retorno desta função.
        // Mantém os usuários anteriores intocados e não os duplica caso já exista
        $group->users()->syncWithoutDetaching($manager->id);
        
        
        
        //var_dump($group->users[0]->groups[0]->id);
        

        // Terá mesmo efeito que: $group->users()->syncWithoutDetaching($memberUser->id);
        return [
            'user_id' => $memberUser->id,
            'group_id' => $group->id,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\GroupUser;
use \App\Models\User;
use \App\Models\Group;

/**
 * @extends Factory<GroupUser>
 */
class GroupUserFactory extends Factory
{

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
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create(),
            'group_id' => Group::inRandomOrder()->value('id') ?? User::factory()->create(),
        ];
    }
}

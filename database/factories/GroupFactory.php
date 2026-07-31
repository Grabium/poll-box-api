<?php

namespace Database\Factories;

//use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;

/**
 * @extends Factory<Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manager_id' => User::inRandomOrder()->value('id') ?? User::factory()->create(),
            'description' => 'Lula ou Bolso?',
        ];
    }
}

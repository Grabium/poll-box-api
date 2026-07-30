<?php

namespace Database\Factories;

use App\Models\Poll;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Group;

/**
 * @extends Factory<Poll>
 */
class PollFactory extends Factory
{

    /**
     * O nome da model correspondente.
     */
    protected $model = Poll::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_id' => Group::inRandomOrder()->value('id') ?? Group::factory()->create(),
            'is_active' => true,
            'name' => fake()->text(10),
            'question' => fake()->text(50),
            'pending_users_visibility' => fake()->boolean(),
            'dead_line' => fake()->dateTimeBetween('now', '1 week'),

        ];
    }
}

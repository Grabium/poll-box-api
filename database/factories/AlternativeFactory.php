<?php

namespace Database\Factories;

use App\Models\Model;
use \App\Models\Poll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class AlternativeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poll_id' => Poll::inRandomOrder()->value('id') ?? Poll::factory()->create(),
            'description' => fake()->text(50),
            'votes' => random_int(0, count(\App\Models\User::all())),
        ];
    }
}

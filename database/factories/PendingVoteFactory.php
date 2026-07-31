<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{PendingVote, User, Poll};

/**
 * @extends Factory<PendingVote>
 */
class PendingVoteFactory extends Factory
{
    /**
     * O nome da model correspondente.
     */
    protected $model = PendingVote::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            //'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create(),
            'user_id' => User::factory()->create(),
            'poll_id' => Poll::inRandomOrder()->value('id') ?? Poll::factory()->create(),
        ];
    }
}

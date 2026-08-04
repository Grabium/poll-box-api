<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative};
use Database\Factories\Helpers\HelperResoucersFactories;

/**
 * @extends Factory<Poll>
 */
class PollFactory extends Factory
{
    //trait
    use HelperResoucersFactories;

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
        $group_id = Group::factory()->create()->id;

        [
            $is_active,
            $name,
            $question,
            $pending_users_visibility,
            $dead_line,
        ] =  $this->createAPoll();

        return [
            'group_id' => $group_id,
            'is_active' => $is_active,
            'name' => $name,
            'question' => $question,
            'pending_users_visibility' => $pending_users_visibility,
            'dead_line' => $dead_line,

        ];
    }
}

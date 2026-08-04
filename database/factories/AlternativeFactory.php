<?php

namespace Database\Factories;

use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative, GroupUser, PendingVote};
use Database\Factories\Helpers\HelperResoucersFactories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class AlternativeFactory extends Factory
{
    //TRAIT 
    use HelperResoucersFactories;

    private int $enterprise_id;

    private function getUserId(): int
    {
        return User::factory()->create(['enterprise_id' => $this->enterprise_id])->id;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $poll_id = Poll::factory()->create()->id;
        
        [
            $description, 
            $votes,//Quantidade sem regras de negócios para quando é semeado isoladamente.
        ] = $this->createAnAlternative();

        return [
            'poll_id' => $poll_id,
            'description' => $description,
            'votes' => $votes,
        ];
    }
}

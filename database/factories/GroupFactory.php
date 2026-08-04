<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative, GroupUser, PendingVote};
use Database\Factories\Helpers\HelperResoucersFactories;

/**
 * @extends Factory<Group>
 */
class GroupFactory extends Factory
{
    //trait
    use HelperResoucersFactories;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::factory()->create()->id;
        [$group_description] = $this->createAGroup();
        
        return [
            'manager_id' => $user_id,
            'description' => $group_description,
        ];
    }
}

<?php

namespace Database\Factories;

use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative, GroupUser, PendingVote};
use Database\Factories\Helpers\HelperResoucersFactories;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $enterprise_id = Enterprise::factory()->create()->id;
        $manager_id = User::factory()->create(['enterprise_id' => $enterprise_id,]);
        $user_id    = User::factory()->create(['enterprise_id' => $enterprise_id,]);
        $group      = Group::factory()->create(['manager_id' => $manager_id,]);
        $group->users()->syncWithoutDetaching($manager_id);
        $group->users()->syncWithoutDetaching($user_id);
        $poll_id =  Poll::factory()->create(['group_id' => $group->id,])->id;
        
        return [
            'user_id' => $user_id,
            'poll_id' => $poll_id,
        ];
    }
}

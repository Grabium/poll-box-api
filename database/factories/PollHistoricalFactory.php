<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative};

/**
 * @extends Factory<PollHistorical>
 */
class PollHistoricalFactory extends Factory
{


    /**
     * O nome da model correspondente.
     */
    protected $model = PollHistorical::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $alternative_id1 = Alternative::factory(1)->create();
        // $alternative_id2 = Alternative::factory(1)->create();

        $enterprise_id = Enterprise::inRandomOrder()->value('id');
        $group_id = /*Group::inRandomOrder()->value('id') ??*/ Group::factory()->create();
        dd(
        $enterprise_id, 
        $group_id,
        );

        return [
            'enterprise_id' => Enterprise::inRandomOrder()->value('id') ?? Enterprise::factory()->create(),
            'group_id' => Group::inRandomOrder()->value('id') ?? Group::factory()->create(),
            'poll_id' => Poll::factory()->count(1)->create(),
            'votes' => [ 5=> random_int(0, count(\App\Models\User::all())),
                         6=> random_int(0, count(\App\Models\User::all())),
            ],
            'votes_pending_after_deadline' => [random_int(0, count(\App\Models\User::all())),
                                               random_int(0, count(\App\Models\User::all())),
            ],
        ];
    }
}

<?php

namespace Database\Factories;

use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative, GroupUser, PendingVote, VoteReceipt};
use Database\Factories\Helpers\HelperResoucersFactories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class VoteReceiptFactory extends Factory
{
    /**
     * Trait para criação de registros coerentes com a regra de negócio
     */
    use HelperResoucersFactories;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $poll = Poll::factory()->create();
        $user = User::factory()->create(['enterprise_id'=> $poll->group->manager->enterprise->id]);
        $date_vote = now()->setTimezone('America/Sao_Paulo')->toDateTimeString(); // formato americano fuzo brasil (yyyy-mm-dd hh:mm:ss)
        $hash_vote_code = \Illuminate\Support\Facades\Crypt::encrypt([$user->id, $poll->id, $date_vote]);


        /**
         * Para descriptografar 
         * retorna um array 
         */
        //dd(\Illuminate\Support\Facades\Crypt::decrypt($hash_vote_code));

        return [
            'poll_id' => $poll->id,
            'user_id' => $user->id,
            'date_vote' => $date_vote,
            'vote_code' => $hash_vote_code,
        ];
    }
}

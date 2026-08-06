<?php

namespace Database\Factories;

use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative, GroupUser, PendingVote};
use Database\Factories\Helpers\HelperResoucersFactories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PollHistorical>
 */
class PollHistoricalFactory extends Factory
{
    /**
     * Trait para criação de registros coerentes com a regra de negócio
     */
    use HelperResoucersFactories;

    // /**
    //  * The current password being used by the factory.
    //  */
    // protected static ?string $password;

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
        $enterprise_id = Enterprise::factory()->create()->id;

        //criando gerente e usuários comuns
        foreach(range(1, 13) as $user_id){
            $users_id[] = User::factory()->create(['enterprise_id' => $enterprise_id,])->id;
        }

        //criando o grupo e o populando com gerente e usuários comuns
        $group = Group::factory()->create(['manager_id' => $users_id[0],]);

        //criando gerente e usuários comuns
        foreach($users_id as $user_id){
            $group->users()->syncWithoutDetaching($user_id);
        }
        
        /**
         * Criando a enquete. 
         * Não será necessário popular votos pendentes,
         * pois trata-se da simulação de uma enquete finalizada.
         */
        $alternatives = [];
        $poll =  Poll::factory()->create(['group_id' => $group->id,]);
        $alternatives[] = Alternative::factory()->create(['poll_id' => $poll->id, 'votes' => 0,]);
        $alternatives[] = Alternative::factory()->create(['poll_id' => $poll->id, 'votes' => 0,]);

        //echo 'Simulação da votação:'.PHP_EOL;
        foreach($group->users as $k => $user){
            if(0 === ($k % 2)){
                PendingVote::create([
                    'user_id' => $user->id,
                    'poll_id' => $poll->id,
                ]);
                //echo 'Usuário  '.$user->id.' NÃO votou'.PHP_EOL;
                continue;
            }
            $changed = fake()->randomElement($alternatives);
            $changed_votes = $changed->votes +1;
            $changed->update(['votes' => $changed_votes]);
            //echo 'Usuário  '.$user->id.' votou em: '.$changed->id.PHP_EOL;
        }

        $votes = Alternative::where('poll_id', $poll->id)->get(['description', 'votes'])->toArray();

        $pendings = PendingVote::where('poll_id', $poll->id)->get(['user_id'])->toArray();

        foreach ($pendings as $vote){
           $pendings_votes[] = $vote['user_id'];
        }
        
        return [
            'enterprise_id' => $enterprise_id,
            'group_id' => $group->id,
            'poll_id' => $poll->id,
            'votes' => $votes,
            'votes_pending_after_deadline' => $pendings_votes,
        ];
    }
}

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
        $manager_id  = User::factory()->create(['enterprise_id' => $enterprise_id,])->id;
        $user_id1    = User::factory()->create(['enterprise_id' => $enterprise_id,])->id;
        $user_id2    = User::factory()->create(['enterprise_id' => $enterprise_id,])->id;
        $user_id3    = User::factory()->create(['enterprise_id' => $enterprise_id,])->id;
        $user_id4    = User::factory()->create(['enterprise_id' => $enterprise_id,])->id;

        //criando o grupo e o populando com gerente e usuários comuns
        $group      = Group::factory()->create(['manager_id' => $manager_id,]);
        $group->users()->syncWithoutDetaching($manager_id);
        $group->users()->syncWithoutDetaching($user_id1);
        $group->users()->syncWithoutDetaching($user_id2);
        $group->users()->syncWithoutDetaching($user_id3);
        $group->users()->syncWithoutDetaching($user_id4);

        /**
         * Criando a enquete. 
         * Não será necessário popular votos pendentes,
         * pois trata-se da simulação de uma enquete finalizada.
         */
        $alternatives = [];
        $poll =  Poll::factory()->create(['group_id' => $group->id,]);
        $alternatives[] = Alternative::factory()->create(['poll_id' => $poll->id, 'votes' => 0,]);
        $alternatives[] = Alternative::factory()->create(['poll_id' => $poll->id, 'votes' => 0,]);

        //echo 'Início da votação:'.PHP_EOL;
        foreach($group->users as $k => $user){
            $changed = fake()->randomElement($alternatives);
            $changed_votes = $changed->votes +1;
            $changed->update(['votes' => $changed_votes]);
            //dd($changed->getAttributes());
            //echo 'Usuário  '.$user->id.' votou em: '.$changed->id.PHP_EOL;
        }

        // A instância $user ainda possui o status antigo na memória.
        // Para atualizar a própria instância $user com os dados do banco:
        dump($alternatives[0]->votes);
        dump($alternatives[1]->votes);
        //dd($alternatives);
        dd(Alternative::find($alternatives[0]->id)->getAttributes(), Alternative::find($alternatives[1]->id)->getAttributes(), );


        // [
        //     $votes,
        // ] = $this->createAPollHistorical();//array
        
        return [
            'enterprise_id' => $enterprise_id,
            'group_id' => $group_id,
            'poll_id' => $poll_id,
            'votes' => $votes,
            'votes_pending_after_deadline' => [random_int(0, count(User::all())),
                                               random_int(0, count(User::all())),
        ]];
    }
}

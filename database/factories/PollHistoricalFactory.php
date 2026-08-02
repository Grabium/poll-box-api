<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<PollHistorical>
 */
class PollHistoricalFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * O nome da model correspondente.
     */
    protected $model = PollHistorical::class;

    /***
     * Função auxiliar
     */
    private function createAnUser(int $enterprise_id): User
    {
        return User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),//Não mudar. DB foi semeado.
            'remember_token' => Str::random(10),
            'enterprise_id' => $enterprise_id,
        ]);
    }

    private function createAPoll(int $group_id): Poll
    {
        return Poll::create([
            'group_id' => $group_id,
            'is_active' => true,
            'name' => fake()->text(10),
            'question' => fake()->text(50),
            'pending_users_visibility' => fake()->boolean(),
            'dead_line' => fake()->dateTimeBetween('now', '1 week'),

        ]);
    }

    private function createAnAlternative(int $poll_id, int $votes): Alternative
    {
        return Alternative::create([
            'poll_id' => $poll_id,
            'description' => fake()->text(50),
            'votes' => $votes,
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //duplicado de GroupUserSeeder
        $enterprise_id = (Enterprise::inRandomOrder()->value('id') ?? Enterprise::factory()->create()->id);

        $manager = $this->createAnUser($enterprise_id);
        $memberUser = $this->createAnUser($enterprise_id);        
        $memberUser1 = $this->createAnUser($enterprise_id);        
        $memberUser2 = $this->createAnUser($enterprise_id);        
        $memberUser3 = $this->createAnUser($enterprise_id);        

        $group = Group::create([
            'manager_id' => $manager->id,
            'description' => fake()->text(20),
        ]);
        
        //Adicionando o gerente do grupo ao grupo junto com seus membros
        // Mantém os usuários anteriores intocados e não os duplica caso já exista
        $group->users()->syncWithoutDetaching($manager->id);
        $group->users()->syncWithoutDetaching($memberUser->id);
        $group->users()->syncWithoutDetaching($memberUser1->id);
        $group->users()->syncWithoutDetaching($memberUser2->id);
        $group->users()->syncWithoutDetaching($memberUser3->id);

        //final da duplicação

        $poll = $this->createAPoll($group->id);

        $alternativesCount = 2;
        $usersCount = count($group->users);
        $voteds = 0;
        $alternatives = [];
        $votes = [];
        for ($i = 0; $i < $alternativesCount; $i++){
            $_votes = ($i == 0) ? random_int(0, ($usersCount)) : ($usersCount - $voteds);
            $voteds = ($voteds + $_votes);
            $alternative = $this->createAnAlternative($poll->id, $_votes);
            $alternatives[] = $alternative;
            $votes[$alternative->id] = $_votes;
        }
        
        return [
            'enterprise_id' => $enterprise_id,
            'group_id' => $group->id,
            'poll_id' => $poll->id,
            'votes' => $votes,
            'votes_pending_after_deadline' => [random_int(0, count(User::all())),
                                               random_int(0, count(User::all())),
        ]];
    }
}

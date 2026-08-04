<?php
namespace Database\Factories\Helpers;

use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//use Database\Factories\Helpers\HelperResoucersFactories;

trait HelperResoucersFactories
{
    public function createAnEnterprise(): Enterprise
    {
        return (Enterprise::factory()->create());
    }

    public function createAnUser(): array
    {
        return [
            fake()->name(),//name
            fake()->unique()->safeEmail(),//email
            now(),//email_verified_at
            static::$password ??= Hash::make('password'),//password
            Str::random(10),//rebember_token
            //$enterprise_id,//enterprise_id
        ];
    }

    public function createAGroup(): array
    {
        return [
            fake()->text(20),//description
        ];
    }

    public function createAPoll(): array
    {
        return [
            true,//'is_active' => 
            fake()->text(10),//'name' => 
            fake()->text(50),//'question' => 
            fake()->boolean(),//'pending_users_visibility' => 
            fake()->dateTimeBetween('now', '1 week'),//'dead_line' => 

        ];
    }

    public function createAnAlternative(): array
    {
        return [
            fake()->text(50),//'description' => 
            3, //$votes,
        ];
    }

    // public function createAPollHistorical(): Array
    // {
    //     $enterprise = Enterprise::find(1) ?? $this->createAnEnterprise();
    //     $enterprise_id = $enterprise->id;

    //     $manager = $this->createAnUser($enterprise_id);
    //     $memberUser = $this->createAnUser($enterprise_id);        
    //     $memberUser1 = $this->createAnUser($enterprise_id);        
    //     $memberUser2 = $this->createAnUser($enterprise_id);        
    //     $memberUser3 = $this->createAnUser($enterprise_id);        

    //     $group = Group::create([
    //         'manager_id' => $manager->id,
    //         'description' => fake()->text(20),
    //     ]);
        
    //     //Adicionando o gerente do grupo ao grupo junto com seus membros
    //     // Mantém os usuários anteriores intocados e não os duplica caso já exista
    //     $group->users()->syncWithoutDetaching($manager->id);
    //     $group->users()->syncWithoutDetaching($memberUser->id);
    //     $group->users()->syncWithoutDetaching($memberUser1->id);
    //     $group->users()->syncWithoutDetaching($memberUser2->id);
    //     $group->users()->syncWithoutDetaching($memberUser3->id);

    //     //final da duplicação

    //     $poll = $this->createAPoll($group->id);

    //     $alternativesCount = 2;
    //     $usersCount = count($group->users);
    //     $voteds = 0;
    //     $alternatives = [];
    //     $votes = [];
    //     for ($i = 0; $i < $alternativesCount; $i++){
    //         $_votes = ($i == 0) ? random_int(0, ($usersCount)) : ($usersCount - $voteds);
    //         $voteds = ($voteds + $_votes);
    //         $alternative = $this->createAnAlternative($poll->id, $_votes);
    //         $alternatives[] = $alternative;
    //         $votes[$alternative->id] = $_votes;
    //     }

    //     return [
    //             $enterprise_id,
    //             $group->id,
    //             $poll->id,
    //             $votes,
    //     ];
    // }
}
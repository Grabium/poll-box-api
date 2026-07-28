<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


// Para criar:
//php artisan make:seeder UserSeeder

// Não esqueça que, o seeder depende do factory se for usar o Helper factory
//php artisan make:factory UserFactory
// Formate o factory antes de rodar o seeder.

// Caso queira semear apenas este:
//php artisan db:seed --class=UserSeeder 

// Ou usar o DatabaseSeeder.
//php artisan db:seed



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$fakeUsers = \App\Models\User::factory->count(10)->make();//make não persiste no DB. Apenas fica na RAM.
        \App\Models\User::factory()->count(20)->create();
    }
}

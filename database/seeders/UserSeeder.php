<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

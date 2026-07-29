<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Busca um usuário existente no banco (ou cria um de teste se o banco estiver vazio)
        $user = User::first() ?? User::factory()->create();
        // $user = User::first() ?? User::factory()->make();//make não persiste no DB. Apenas fica na RAM.
        $group = $user->managedGroups()->create([
            'description' => 'Equipe de Desenvolvimento PHP',
        ]);
    }
}

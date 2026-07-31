<?php

namespace Database\Seeders;

//use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//php artisan db:seed

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 
     * Dependências:
     * Enterprise <- User <- Group <- Poll <- Alternative <-
     */
    public function run(): void
    {
        $this->call([
            EnterpriseSeeder::class,
            UserSeeder::class,
            GroupSeeder::class,
            PollSeeder::class,
            AlternativeSeeder::class,
        ]);

    }
}

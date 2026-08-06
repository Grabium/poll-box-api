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
     */
    public function run(): void
    {
        $this->call([
            EnterpriseSeeder::class,
            UserSeeder::class,
            GroupSeeder::class,
            PollSeeder::class,
            AlternativeSeeder::class,
            GroupUserSeeder::class,
            PendingVoteSeeder::class,
            PollHistoricalSeeder::class,
            VoteReceiptSeeder::class,
        ]);

    }
}

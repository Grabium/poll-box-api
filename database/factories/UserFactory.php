<?php

namespace Database\Factories;

use \App\Models\{PollHistorical, Enterprise, User, Group, Poll, Alternative, GroupUser, PendingVote};
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Helpers\HelperResoucersFactories;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /***
     * trait
     */
    use HelperResoucersFactories;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enterprise_id = $this->createAnEnterprise()->id;

        [   $name,
            $email,
            $email_verified_at,
            $password,
            $remember_token,
        ] = $this->createAnUser();
        
        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => $email_verified_at,
            'password' => $password,
            'remember_token' => $remember_token,
            'enterprise_id' => $enterprise_id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

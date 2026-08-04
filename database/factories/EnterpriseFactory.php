<?php

namespace Database\Factories;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enterprise>
 */
class EnterpriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cadastro_nacional' => fake()->regexify('[A-Z0-9]{12}[0-9]{2}'),
            'razao_social' => fake()->company(),
        ];
    }
}

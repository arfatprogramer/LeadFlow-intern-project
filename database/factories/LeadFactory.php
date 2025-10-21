<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'status' => $this->faker->randomElement(['New', 'Contacted', 'Qualified', 'Lost']),
            'source' => $this->faker->randomElement(['Website', 'Referral', 'Social Media', 'Advertisement']),
            'assigned_to' => rand(1, 5),
            // 'user_id' => rand(1, 5),
            'notes' => $this->faker->paragraph(),
           
        ];
    }
}

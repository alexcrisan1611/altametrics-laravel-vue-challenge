<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'vendor_name' => $this->faker->company(),
            'amount' => $this->faker->numberBetween(10, 1000),
            'due_date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'paid' => $this->faker->boolean(80),
        ];
    }
}

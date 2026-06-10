<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->numberBetween(1, 3),
            'email' => fake()->safeEmail(),
            'tel' => fake()->randomNumber(9, true),
            'address' => fake()->prefecture() .fake()->city() .fake()->streetAddress(),
            'building' => fake()->secondaryAddress(),
            'category_id' => fake()->numberBetween(1, 5),
            'detail' => fake()->realText(120),
        ];
    }
}

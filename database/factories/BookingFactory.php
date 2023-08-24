<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'participants' => fake()->numberBetween(1, 5),
            'fee' => fake()->randomDigit(),
            'book_date' => fake()->date,
            'discount' => fake()->randomDigit(),
            'room_id' => fake()->randomDigit(),
        ];
    }
}

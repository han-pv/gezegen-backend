<?php

namespace Database\Factories;

use App\Models\Hotel\City;
use App\Models\Hotel\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Hotel>
 */
class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {

        $name = fake()->unique()->company() . ' Hotel';
        return [
            'city_id' => City::factory(),
            'name' => $name,
            'slug' => fake()->unique()->slug(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'rating' => fake()->numberBetween(1, 5),
            'description' => fake()->paragraph(),
            'image' => null,
            'active' => fake()->boolean(80),
        ];
    }
}

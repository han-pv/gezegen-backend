<?php

namespace Database\Factories;

use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::factory(),
            'room_type' => fake()->randomElement(['Single', 'Double', 'Suite', 'Deluxe', 'Family']),
            'capacity' => fake()->numberBetween(1, 10),
            'price_per_night' => fake()->randomFloat(2, 40, 600),
            'is_available' => fake()->boolean(85),
            'description' => fake()->paragraph(),
        ];
    }
}

<?php

namespace Database\Factories\Hotel;

use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::query()->inRandomOrder()->value('id') ?? Hotel::factory(),
            'name' => 'Room '.fake()->unique()->numerify('###'),
            'room_type' => fake()->randomElement(['Deluxe', 'Suite', 'Standard']),
            'price' => fake()->randomFloat(2, 50, 500),
            'is_available' => fake()->boolean(70),
        ];
    }
}

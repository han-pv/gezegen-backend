<?php

namespace Database\Factories\Tickets;

use App\Models\Tickets\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tickets\City;


/**
 * @extends Factory<Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_id' => City::factory(), // Автоматически создаст город, если он не передан
            'name' => $this->faker->company() . ' Airport',
            'code' => strtoupper($this->faker->unique()->lexify('???')), // Трехбуквенный IATA код
        ];
    }
}

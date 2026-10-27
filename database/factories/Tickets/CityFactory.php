<?php

namespace Database\Factories\Tickets;

use App\Models\Tickets\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->city();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}

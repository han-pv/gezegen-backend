<?php

namespace Database\Factories;

use App\Models\Hotel\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->unique()->city();

        return [
            'name' => fake()->unique()->city(),
            'slug'    => Str::slug($name),
            'country' => fake()->randomElement([
                'Turkmenistan', 'Turkey', 'UAE', 'Russia', 'Germany', 'Kazakhstan', 'England', 'America', 'Uzbekistan',
            ]),
        ];
    }
}

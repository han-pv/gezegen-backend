<?php

namespace Database\Factories\Hotel;

use App\Models\Hotel\City;
use App\Models\Hotel\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'city_id' => $this->cityId(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numerify('###'),
            'address' => fake()->streetAddress(),
            'capacity' => fake()->numberBetween(1, 500),
            'stars' => fake()->numberBetween(1, 5),
            'phone' => fake()->phoneNumber(),
            'image' => 'hotels/'.Str::uuid().'.jpg',
            'rating' => fake()->randomFloat(2, 1, 5),
            'active' => fake()->boolean(90),
            'email' => fake()->unique()->companyEmail(),
            'description' => fake()->paragraph(),
        ];
    }

    /**
     * Use a seeded city when one exists, otherwise create a fallback city.
     */
    private function cityId(): int
    {
        $cityId = City::query()->inRandomOrder()->value('id');

        if ($cityId !== null) {
            return $cityId;
        }

        return City::query()->create([
            'name' => 'İstanbul',
            'slug' => 'istanbul',
        ])->id;
    }
}

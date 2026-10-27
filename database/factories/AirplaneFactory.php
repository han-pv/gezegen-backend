<?php

namespace Database\Factories;

use App\Models\Ticket\Airplane;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirplaneFactory extends Factory
{
    protected $model = Airplane::class;

    public function definition(): array
    {
        [$model, $capacity] = fake()->randomElement([
            ['Boeing 737-800', 189],
            ['Airbus A320', 180],
            ['Airbus A321', 200],
            ['Boeing 777-300ER', 396],
            ['Embraer E190', 100],
        ]);

        return [
            'airline'             => fake()->randomElement([
                'Turkmenistan Airlines', 'Turkish Airlines', 'Emirates', 'Aeroflot',
            ]),
            'model'               => $model,
            'registration_number' => strtoupper(fake()->unique()->bothify('??-###')),
            'capacity'            => $capacity,
            'active'              => true,
        ];
    }
}
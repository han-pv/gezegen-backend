<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\Airport;
use App\Models\Ticket\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $airports = Airport::all();

        $depAirport = $airports->random();
        do {
            $arrAirport = $airports->random();
        } while ($depAirport->id === $arrAirport->id);

        $airlines = ['American Airlines', 'Delta Air Lines', 'United Airlines', 'JetBlue', 'Alaska Airlines'];

        $hour = rand(6, 22);
        $minute = rand(0, 59);
        $depTime = Carbon::create(2026, 10, 26, $hour, $minute, 0);
        $arrTime = (clone $depTime)->addHours(rand(2, 6))->addMinutes(rand(15, 45));


        return [
            'airline' => $airlines[array_rand($airlines)],
            'flight_code' => 'FL' . $this->faker->unique()->numberBetween(1000, 9999),
            'departure_airport_id' => $depAirport->id,
            'arrival_airport_id' => $arrAirport->id,
            'departure_time' => $depTime->toDateTimeString(),
            'arrival_time' => $arrTime->toDateTimeString(),
            'price' => rand(90, 450) + 0.99,
            'empty_seats' => rand(5, 50),
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Models\Hotel\City;
use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_rooms_index_filters_by_query_parameters(): void
    {
        $city = City::query()->create([
            'name' => 'Istanbul',
            'slug' => 'istanbul',
        ]);

        $hotel = Hotel::factory()->create(['city_id' => $city->id]);
        $other = Hotel::factory()->create(['city_id' => $city->id]);

        $match = Room::factory()->create([
            'hotel_id' => $hotel->id,
            'room_type' => 'Suite',
            'price' => 200,
            'is_available' => true,
        ]);

        Room::factory()->create([
            'hotel_id' => $hotel->id,
            'room_type' => 'Standard',
            'price' => 200,
            'is_available' => true,
        ]);

        Room::factory()->create([
            'hotel_id' => $other->id,
            'room_type' => 'Suite',
            'price' => 200,
            'is_available' => true,
        ]);

        Room::factory()->create([
            'hotel_id' => $hotel->id,
            'room_type' => 'Suite',
            'price' => 50,
            'is_available' => true,
        ]);

        Room::factory()->create([
            'hotel_id' => $hotel->id,
            'room_type' => 'Suite',
            'price' => 200,
            'is_available' => false,
        ]);

        $response = $this->getJson('/api/rooms?hotel_id='.$hotel->id.'&price_start=100&price_end=300&is_available=true&room_type=suite');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.id', $match->id);
        $response->assertJsonPath('data.0.room_type', 'Suite');
        $response->assertJsonPath('data.0.is_available', true);
    }

    public function test_rooms_show_returns_one_room(): void
    {
        $city = City::query()->create([
            'name' => 'Ankara',
            'slug' => 'ankara',
        ]);
        $hotel = Hotel::factory()->create(['city_id' => $city->id]);
        $room = Room::factory()->create(['hotel_id' => $hotel->id]);

        $this->getJson('/api/rooms/'.$room->id)
            ->assertOk()
            ->assertJsonPath('data.id', $room->id)
            ->assertJsonPath('data.hotel_id', $hotel->id);
    }

    public function test_hotel_rooms_returns_only_that_hotels_rooms(): void
    {
        $city = City::query()->create([
            'name' => 'Izmir',
            'slug' => 'izmir',
        ]);
        $hotel = Hotel::factory()->create(['city_id' => $city->id]);
        $other = Hotel::factory()->create(['city_id' => $city->id]);

        Room::factory()->count(2)->create(['hotel_id' => $hotel->id]);
        Room::factory()->create(['hotel_id' => $other->id]);

        $this->getJson('/api/hotels/'.$hotel->id.'/rooms')
            ->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.hotel_id', $hotel->id)
            ->assertJsonPath('data.1.hotel_id', $hotel->id);
    }
}

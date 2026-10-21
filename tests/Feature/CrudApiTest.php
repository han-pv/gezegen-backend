<?php

namespace Tests\Feature;

use App\Models\Hotel\City;
use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_city_hotel_and_room_crud(): void
    {
        $cityResponse = $this->postJson('/api/cities', [
            'name' => 'Istanbul',
            'slug' => 'istanbul',
        ]);

        $cityResponse->assertCreated();
        $cityId = $cityResponse->json('data.id');

        $this->getJson('/api/cities/'.$cityId)
            ->assertOk()
            ->assertJsonPath('data.name', 'Istanbul');

        $this->putJson('/api/cities/'.$cityId, [
            'name' => 'Ankara',
            'slug' => 'ankara',
        ])->assertOk()
            ->assertJsonPath('data.slug', 'ankara');

        $hotelResponse = $this->postJson('/api/hotels', [
            'city_id' => $cityId,
            'name' => 'Gezegen Hotel',
            'slug' => 'gezegen-hotel',
            'stars' => 4,
        ]);

        $hotelResponse->assertCreated();
        $hotelId = $hotelResponse->json('data.id');

        $this->putJson('/api/hotels/'.$hotelId, [
            'city_id' => $cityId,
            'name' => 'Gezegen Hotel',
            'slug' => 'gezegen-hotel-2',
            'stars' => 5,
        ])->assertOk()
            ->assertJsonPath('data.stars', 5);

        $roomResponse = $this->postJson('/api/rooms', [
            'hotel_id' => $hotelId,
            'name' => 'Room 101',
            'room_type' => 'Suite',
            'price' => 250,
            'is_available' => true,
        ]);

        $roomResponse->assertCreated();
        $roomId = $roomResponse->json('data.id');

        $this->putJson('/api/rooms/'.$roomId, [
            'hotel_id' => $hotelId,
            'name' => 'Room 102',
            'room_type' => 'Deluxe',
            'price' => 180,
            'is_available' => false,
        ])->assertOk()
            ->assertJsonPath('data.name', 'Room 102')
            ->assertJsonPath('data.is_available', false);

        $this->deleteJson('/api/rooms/'.$roomId)
            ->assertOk()
            ->assertJsonPath('message', 'Room deleted');

        $this->assertDatabaseMissing('rooms', ['id' => $roomId]);

        $this->deleteJson('/api/hotels/'.$hotelId)
            ->assertOk();
        $this->assertDatabaseMissing('hotels', ['id' => $hotelId]);

        $this->deleteJson('/api/cities/'.$cityId)
            ->assertOk();
        $this->assertDatabaseMissing('cities', ['id' => $cityId]);
    }

    public function test_missing_records_return_not_found(): void
    {
        $this->getJson('/api/cities/999')->assertNotFound();
        $this->getJson('/api/hotels/999')->assertNotFound();
        $this->getJson('/api/rooms/999')->assertNotFound();

        $this->assertSame(0, City::query()->count());
        $this->assertSame(0, Hotel::query()->count());
        $this->assertSame(0, Room::query()->count());
    }
}

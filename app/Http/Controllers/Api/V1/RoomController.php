<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel\Room;

class RoomController extends Controller
{
    public function index(Request $request)
{
    $request->validate([
        'hotel_id'     => 'sometimes|integer|exists:hotels,id',
        'price_start'  => 'sometimes|numeric|min:0',
        'price_end'    => 'sometimes|numeric|gte:price_start',
        'is_available' => 'sometimes|boolean',
        'room_type'    => 'sometimes|in:deluxe,suite,standard',
    ]);

    $rooms = Room::query()
        ->when($request->filled('hotel_id'), fn ($q) => $q->where('hotel_id', $request->hotel_id))
        ->when($request->filled('price_start'), fn ($q) => $q->where('price', '>=', $request->price_start))
        ->when($request->filled('price_end'), fn ($q) => $q->where('price', '<=', $request->price_end))
        ->when($request->has('is_available'), fn ($q) => $q->where('is_available', $request->boolean('is_available')))
        ->when($request->filled('room_type'), fn ($q) => $q->where('room_type', strtolower($request->room_type)))
        ->paginate(15);

    return response()->json($rooms);
}

public function show(Room $room)
{
    return response()->json($room);
}
}

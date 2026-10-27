<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Hotel\Hotel;
use App\Models\Hotel\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('room_type')) {
            $request->merge([
                'room_type' => ucfirst(strtolower(trim((string) $request->input('room_type')))),
            ]);
        }

        if ($request->filled('is_available') && is_string($request->input('is_available'))) {
            $available = filter_var($request->input('is_available'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            if ($available !== null) {
                $request->merge([
                    'is_available' => $available,
                ]);
            }
        }

        $request->validate([
            'hotel_id' => 'nullable|integer|exists:hotels,id',
            'price_start' => 'nullable|numeric|min:0',
            'price_end' => 'nullable|numeric|min:0',
            'is_available' => 'nullable|boolean',
            'room_type' => ['nullable', 'string', Rule::in(['Deluxe', 'Suite', 'Standard'])],
        ]);

        $query = Room::query();

        if ($request->filled('hotel_id')) {
            $query->where('hotel_id', $request->integer('hotel_id'));
        }

        if ($request->filled('price_start')) {
            $query->where('price', '>=', $request->input('price_start'));
        }

        if ($request->filled('price_end')) {
            $query->where('price', '<=', $request->input('price_end'));
        }

        if ($request->filled('is_available')) {
            $query->where('is_available', $request->boolean('is_available'));
        }

        if ($request->filled('room_type')) {
            $query->where('room_type', $request->input('room_type'));
        }

        return RoomResource::collection($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id' => 'required|integer|exists:hotels,id',
            'name' => 'required|string|max:255',
            'room_type' => ['required', 'string', Rule::in(['Deluxe', 'Suite', 'Standard'])],
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
        ]);

        $room = Room::create($data);

        return (new RoomResource($room))->response()->setStatusCode(201);
    }

    public function show(Room $room)
    {
        return new RoomResource($room);
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'hotel_id' => 'required|integer|exists:hotels,id',
            'name' => 'required|string|max:255',
            'room_type' => ['required', 'string', Rule::in(['Deluxe', 'Suite', 'Standard'])],
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
        ]);

        $room->update($data);

        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'message' => 'Room deleted',
        ], 200);
    }

    public function forHotel(Hotel $hotel)
    {
        return RoomResource::collection($hotel->rooms()->get());
    }
}

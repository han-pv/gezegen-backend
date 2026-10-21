<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'stars' => 'nullable|integer|min:1|max:5',
            'cityId' => 'nullable|integer|exists:cities,id',
        ]);

        $query = Hotel::query()->with('city');

        if ($request->filled('stars')) {
            $query->where('stars', $request->stars);
        }

        if ($request->filled('cityId')) {
            $query->where('city_id', $request->cityId);
        }

        return HotelResource::collection($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'city_id' => 'required|integer|exists:cities,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:hotels,slug',
            'address' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:1',
            'stars' => 'nullable|integer|min:1|max:5',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'active' => 'nullable|boolean',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
        ]);

        $hotel = Hotel::create($data);

        return (new HotelResource($hotel))->response()->setStatusCode(201);
    }

    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'city_id' => 'required|integer|exists:cities,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:hotels,slug,'.$hotel->id,
            'address' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:1',
            'stars' => 'nullable|integer|min:1|max:5',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'active' => 'nullable|boolean',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
        ]);

        $hotel->update($data);

        return new HotelResource($hotel);
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return response()->json([
            'message' => 'Hotel deleted',
        ], 200);
    }
}

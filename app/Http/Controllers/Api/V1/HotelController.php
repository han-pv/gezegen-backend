<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelStoreRequest;
use App\Http\Requests\HotelUpdateRequest;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $perPage = min($request->integer('per_page', 24), 50);

        $hotels = Hotel::query()
            ->when($request->filled('rating'), fn ($q) => $q->where('rating', $request->rating))
            ->orderBy('id')
            ->paginate($perPage)
            ->withQueryString();

        return response()->json($hotels);
    }

    public function store(HotelStoreRequest $request)
    {
        $hotel = Hotel::create($request->validated());

        return response()->json($hotel, 201);
    }

    public function update(HotelUpdateRequest $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->update($request->validated());

        return response()->json($hotel, 200);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);

        return response()->json($hotel);
    }

    public function destroy($id)
    {
        $Hotel = Hotel::find($id);
        $Hotel->delete();

        return response()->json(null, 204);
    }
}
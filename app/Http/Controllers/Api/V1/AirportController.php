<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AirportResource;
use App\Models\Ticket\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index()
    {
        return AirportResource::collection(Airport::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:airports,code',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $airport = Airport::create($validated);

        return new AirportResource($airport);
    }

    public function show(Airport $airport)
    {
        return new AirportResource($airport);
    }

    public function update(Request $request, Airport $airport)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|size:3|unique:airports,code,' . $airport->id,
            'city' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
        ]);

        $airport->update($validated);

        return new AirportResource($airport);
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();

        return response()->json(null, 204);
    }
}

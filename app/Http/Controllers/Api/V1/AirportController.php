<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAirportRequest;
use App\Http\Requests\Api\V1\UpdateAirportRequest;
use App\Models\Airport;

class AirportController extends Controller
{
    public function index()
    {
        return response()->json(Airport::all());
    }

    public function store(StoreAirportRequest $request)
    {
        $airport = Airport::create($request->validated());
        return response()->json($airport, 201);
    }

    public function show(string $id)
    {
        $airport = Airport::findOrFail($id);
        return response()->json($airport);
    }

    public function update(UpdateAirportRequest $request, string $id)
    {
        $airport = Airport::findOrFail($id);
        $airport->update($request->validated());
        return response()->json($airport);
    }

    public function destroy(string $id)
    {
        $airport = Airport::findOrFail($id);
        $airport->delete();
        return response()->json(['message' => 'Airport deleted successfully']);
    }
}

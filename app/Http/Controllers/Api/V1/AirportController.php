<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Airport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Airport::with('city');

        if ($request->has('city_id')) {
            $query->where('city_id', $request->query('city_id'));
        }

        $airports = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $airports
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:airports,code',
            'city_id' => 'required|exists:cities,id',
            'timezone' => 'nullable|string|max:100',
        ]);

        $airport = Airport::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully created',
            'data' => $airport->load('city')
        ], 201);
    }

    public function show(Airport $airport): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $airport->load('city')
        ], 200);
    }

    public function update(Request $request, Airport $airport): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:10|unique:airports,code,' . $airport->id,
            'city_id' => 'sometimes|required|exists:cities,id',
            'timezone' => 'sometimes|nullable|string|max:100',
        ]);

        $airport->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully updated',
            'data' => $airport->load('city')
        ], 200);
    }

    public function destroy(Airport $airport): JsonResponse
    {
        $airport->delete();

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully deleted'
        ], 200);
    }
}
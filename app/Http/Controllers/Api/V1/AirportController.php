<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirportStoreRequest;
use App\Http\Requests\AirportUpdateRequest;
use App\Http\Resources\AirportResource;
use App\Models\Api\V1\Airport;

class AirportController extends Controller
{
    public function index()
    {
        $airports = Airport::get();

        return AirportResource::collection($airports)->additional(['success' => true]);
    }
    public function store(AirportStoreRequest $request)
    {
        $airport = Airport::create($request->validated());

        return (new AirportResource($airport->load(['city'])))
            ->additional(['success' => true, 'message' => 'Airport successfully created'])
            ->response()
            ->setStatusCode(201);
    }
    public function show(Airport $airport)
    {
        return (new AirportResource($airport->load(['city'])))
            ->additional(['success' => true]);
    }

    public function update(AirportUpdateRequest $request, Airport $airport)
    {
        $airport->update($request->validated());

        return (new AirportResource($airport->load(['city'])))
            ->additional(['success' => true, 'message' => 'Airport successfully updated']);
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully deleted'
        ], 200);
    }
}

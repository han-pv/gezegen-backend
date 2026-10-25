<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FlightStoreRequest;
use App\Http\Requests\FlightUpdateRequest;
use App\Http\Resources\FlightResource;
use App\Models\Api\V1\Flight;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::get();

        return FlightResource::collection($flights)->additional(['success' => true]);
    }
    public function store(FlightStoreRequest $request)
    {
        $flight = Flight::create($request->validated());

        return (new FlightResource($flight->load(['airport_from', 'airport_to', 'tickets'])))
            ->additional(['success' => true, 'message' => 'Flight successfully created'])
            ->response()
            ->setStatusCode(201);
    }
    public function show(Flight $flight)
    {
        return (new FlightResource($flight->load(['airport_from', 'airport_to', 'tickets'])))
            ->additional(['success' => true]);
    }

    public function update(FlightUpdateRequest $request, Flight $flight)
    {
        $flight->update($request->validated());

        return (new FlightResource($flight->load(['airport_from', 'airport_to', 'tickets'])))
            ->additional(['success' => true, 'message' => 'Flight successfully updated']);
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully deleted'
        ], 200);
    }
}

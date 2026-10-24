<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePassengerRequest;
use App\Http\Requests\Api\V1\UpdatePassengerRequest;
use App\Models\Passenger;

class PassengerController extends Controller
{
    public function index()
    {
        return response()->json(Passenger::with('tickets')->get());
    }

    public function store(StorePassengerRequest $request)
    {
        $passenger = Passenger::create($request->validated());
        return response()->json($passenger, 201);
    }

    public function show(string $id)
    {
        $passenger = Passenger::with(['tickets.flight'])->findOrFail($id);
        return response()->json($passenger);
    }

    public function update(UpdatePassengerRequest $request, string $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->update($request->validated());
        return response()->json($passenger);
    }

    public function destroy(string $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();
        return response()->json(['message' => 'Passenger deleted successfully']);
    }
}

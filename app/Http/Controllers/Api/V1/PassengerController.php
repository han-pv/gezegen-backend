<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassengerResource;
use App\Models\Ticket\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {
        return PassengerResource::collection(Passenger::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
        ]);

        $passenger = Passenger::create($validated);

        return new PassengerResource($passenger);
    }

    public function show(Passenger $passenger)
    {
        return new PassengerResource($passenger);
    }

    public function update(Request $request, Passenger $passenger)
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
        ]);

        $passenger->update($validated);

        return new PassengerResource($passenger);
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();

        return response()->json(null, 204);
    }
}

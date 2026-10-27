<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\PassengerStoreRequest;
use App\Http\Resources\PassengerResource;
use App\Models\Tickets\Passenger;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::get();

        return PassengerResource::collection($passengers)->additional(['success' => true]);
    }
    public function store(PassengerStoreRequest $request)
    {
        $passenger = Passenger::create($request->validated());

        return (new PassengerResource($passenger))
            ->additional(['success' => true, 'message' => 'Passenger successfully created'])
            ->response()
            ->setStatusCode(201);
    }
    public function show(Passenger $passenger)
    {
        return (new PassengerResource($passenger))
            ->additional(['success' => true]);
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully deleted'
        ], 200);
    }
    
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\PassengerResource;
use App\Models\Ticket\Passenger;

class PassengerController extends Controller
{
    public function index()
    {
        return PassengerResource::collection(Passenger::all());
    }
    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        return new PassengerResource($passenger);
    }
}

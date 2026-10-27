<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\AirportResource;
use App\Models\Ticket\Airport;

class AirportController extends Controller
{
    public function index()
    {
        return AirportResource::collection(Airport::all());
    }
    public function show($id)
    {
        $airport = Airport::findOrFail($id);
        return new AirportResource($airport);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AirportResource;
use App\Models\Ticket\Airport;

class AirportController extends Controller
{
    public function index()
    {
        return AirportResource::collection(Airport::orderBy('city')->get());
    }

    public function show(Airport $airport)
    {
        return new AirportResource($airport);
    }
}
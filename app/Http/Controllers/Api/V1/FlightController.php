<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Flight;
use Illuminate\Http\Request;
use App\Http\Requests\FlightIndexRequest;
use App\Http\Requests\FlightStoreRequest;
use App\Models\Hotel\City;
use App\Models\Ticket\Airplane;

class FlightController extends Controller
{
    public function index(FlightIndexRequest $request)
    {
        $count = $request->integer('passengers', 1);

    $flights = Flight::query()
        ->with(['fromCity', 'toCity'])
        ->where('active', true)
        ->where('available_seats', '>=', $count)
        ->where('departure_at', '>', now())
        ->when($request->filled('from'), fn ($q) => $q->where('from_city_id', $request->from))
        ->when($request->filled('to'), fn ($q) => $q->where('to_city_id', $request->to))
        ->when($request->filled('date'), fn ($q) => $q->whereDate('departure_at', $request->date))
        ->orderBy('departure_at')
        ->paginate($request->integer('per_page', 6))
        ->withQueryString()
        ->through(function ($flight) use ($count) {
            $flight->setAttribute('total_price', round($flight->price * $count, 2));
            return $flight;
        });

        return response()->json($flights);
    }

    public function locations()
    {
        $cities = City::orderBy('country')->orderBy('name')->get(['id', 'name', 'country']);

        return response()->json(
            $cities->groupBy('country')
                ->map(fn ($items, $country) => [
                    'country' => $country,
                    'cities'  => $items->values(),
                ])
                ->values()
        );
    }

    public function show($id)
    {
        return response()->json(
            Flight::with(['fromCity', 'toCity'])->findOrFail($id)
        );
    }

    public function store(FlightStoreRequest $request)
    {
        $data     = $request->validated();
        $airplane = Airplane::findOrFail($data['airplane_id']);

        $data['airline']         = $airplane->airline;
        $data['total_seats']     = $airplane->capacity;
        $data['available_seats'] = $airplane->capacity;

        $flight = Flight::create($data);

        return response()->json($flight->load('fromCity', 'toCity', 'airplane'), 201);
    }
}
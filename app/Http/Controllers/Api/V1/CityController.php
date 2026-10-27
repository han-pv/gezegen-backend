<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Models\Tickets\City;
// use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::get();

        return CityResource::collection($cities)->additional(['success' => true]);
    }
    public function store(CityStoreRequest $request)
    {
        $city = City::create($request->validated());

        return (new CityResource($city))
            ->additional(['success' => true, 'message' => 'City successfully created'])
            ->response()
            ->setStatusCode(201);
    }
    public function show(City $city)
    {
        return (new CityResource($city))
            ->additional(['success' => true]);
    }

    public function update(CityUpdateRequest $request, City $city)
    {
        $city->update($request->validated());

        return (new CityResource($city))
            ->additional(['success' => true, 'message' => 'City successfully updated']);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'success' => true,
            'message' => 'City successfully deleted'
        ], 200);
    }
}

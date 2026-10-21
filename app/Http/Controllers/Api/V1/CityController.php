<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\Hotel\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return CityResource::collection(City::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cities,slug',
        ]);

        $city = City::create($data);

        return (new CityResource($city))->response()->setStatusCode(201);
    }

    public function show(City $city)
    {
        return new CityResource($city);
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cities,slug,'.$city->id,
        ]);

        $city->update($data);

        return new CityResource($city);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'message' => 'City deleted',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hotel\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::paginate(24);

        return response()->json($cities);
    }

    public function show($id)
    {
        $city = City::find($id);

        return response()->json($city);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:cities,slug',
            'code' => 'required|string|max:10',
        ]);

        $city = City::create($validated);

        return response()->json($city, 201);
    }

    public function update($id, Request $request)
    {
        $city = City::find($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:cities,slug,' . $id,
            'code' => 'required|string|max:10',
        ]);

        $city->update($validated);

        return response()->json($city, 201);

    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();

        return response()->json(null, 204);
    }
}

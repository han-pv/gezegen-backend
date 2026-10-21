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
        $cities = City::get();
        return CityResource::collection($cities);
    }

    public function show(City $city)
    {
        return new CityResource($city);
    }
}

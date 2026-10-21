<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(HotelRequest $request)
    {
        $query = Hotel::query();
        if (!empty($request->stars)) {
            $query->where('stars', $request->stars);
        }

        if (!empty($request->cityId)) {
            $query->where('city_id', $request->cityId);
        }

        $hotels = $query->with('city')->get();
        // ----------------------------------------------------------------
        // $r_stars = $request->stars;

        // $h = Hotel::when(!empty($request->stars), function ($q) use ($r_stars) {
        //     return $q->where('stars', $r_stars);
        // })->get();

        return HotelResource::collection($hotels);
    }
}

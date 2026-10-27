<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirplaneStoreRequest;
use App\Models\Ticket\Airplane;
use Illuminate\Http\Request;

class AirplaneController extends Controller
{
    public function index(Request $request)
    {
        $airplanes = Airplane::query()
            ->orderBy('airline')
            ->orderBy('model')
            ->paginate(min($request->integer('per_page', 10), 50));

        return response()->json($airplanes);
    }

    public function show($id)
    {
        return response()->json(Airplane::findOrFail($id));
    }

    public function store(AirplaneStoreRequest $request)
    {
        $airplane = Airplane::create($request->validated());

        return response()->json($airplane, 201);
    }
}
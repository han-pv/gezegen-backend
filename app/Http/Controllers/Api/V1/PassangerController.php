<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Passanger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PassangerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Passanger::query();

        if ($request->has('full_name')) {
            $query->where('full_name', 'like', '%' . $request->query('full_name') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', $request->query('email'));
        }

        if ($request->has('passport_code')) {
            $query->where('passport_code', $request->query('passport_code'));
        }

        $passengers = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $passengers
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'card_num' => 'required|string|max:50',
            'passport_code' => 'required|string|max:50|unique:passengers,passport_code',
            'phone' => 'nullable|string|max:50',
        ]);

        $passenger = Passanger::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully created',
            'data' => $passenger
        ], 201);
    }

    public function show(Passanger $passenger): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $passenger->load('tickets')
        ], 200);
    }

    public function update(Request $request, Passanger $passenger): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:passengers,email,' . $passenger->id,
            'card_num' => 'sometimes|required|string|max:50',
            'passport_code' => 'sometimes|required|string|max:50|unique:passengers,passport_code,' . $passenger->id,
            'phone' => 'nullable|string|max:50',
        ]);

        $passenger->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully updated',
            'data' => $passenger
        ], 200);
    }

    public function destroy(Passanger $passenger): JsonResponse
    {
        $passenger->delete();

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully deleted'
        ], 200);
    }
}
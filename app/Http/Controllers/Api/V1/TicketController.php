<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Passanger;
use App\Models\Ticket\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::with(['passanger', 'flight']);

        if ($request->has('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->has('passanger_id')) {
            $query->where('passanger_id', $request->query('passanger_id'));
        }

        if ($request->has('flight_id')) {
            $query->where('flight_id', $request->query('flight_id'));
        }

        $tickets = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $tickets
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'seats_count' => 'required|integer|min:1',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'card_num' => 'required|string|max:50',
            'passport_code' => 'required|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            $flight = Flight::lockForUpdate()->findOrFail($validated['flight_id']);

            if ($flight->empty_seats < $validated['seats_count']) {
                return response()->json([
                    'success' => false,
                    'message' => 'На данном рейсе недостаточно свободных мест!'
                ], 400);
            }

            $passenger = Passanger::firstOrCreate(
                ['passport_code' => $validated['passport_code']],
                [
                    'full_name' => $validated['full_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'card_num' => $validated['card_num'],
                ]
            );

            $totalPrice = $flight->price * $validated['seats_count'];

            $ticket = Ticket::create([
                'flight_id' => $flight->id,
                'passanger_id' => $passenger->id,
                'seats_count' => $validated['seats_count'],
                'total_price' => $totalPrice,
                'status' => 'booked',
            ]);

            $flight->empty_seats -= $validated['seats_count'];
            $flight->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Билет успешно забронирован!',
                'data' => $ticket->load(['passanger', 'flight'])
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при бронировании билета',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $ticket->load(['passanger', 'flight'])
        ], 200);
    }

    public function update(Request $request, Ticket $ticket): JsonResponse
    {
        $validated = $request->validate([
            'passanger_id' => 'sometimes|required|exists:passangers,id',
            'flight_id' => 'sometimes|required|exists:flights,id',
            'seats_count' => 'sometimes|required|integer|min:1',
            'total_price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|in:booked,confirmed,cancelled',
        ]);

        $ticket->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ticket successfully updated',
            'data' => $ticket->load(['passanger', 'flight'])
        ], 200);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $flight = Flight::find($ticket->flight_id);
        if ($flight) {
            $flight->empty_seats += $ticket->seats_count;
            $flight->save();
        }

        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket successfully deleted and seats restored'
        ], 200);
    }
}
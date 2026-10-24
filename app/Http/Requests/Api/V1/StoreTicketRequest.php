<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'flight_id'    => 'required|exists:flights,id',
            'passenger_id' => 'required|exists:passengers,id',
            'seat_number'  => 'required|string',
            'status'       => 'sometimes|in:booked,cancelled,completed',
            'price'        => 'required|numeric|min:0',
        ];
    }
}

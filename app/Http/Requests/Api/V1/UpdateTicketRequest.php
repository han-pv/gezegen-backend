<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'flight_id'    => 'sometimes|exists:flights,id',
            'passenger_id' => 'sometimes|exists:passengers,id',
            'seat_number'  => 'sometimes|string',
            'status'       => 'sometimes|in:booked,cancelled,completed',
            'price'        => 'sometimes|numeric|min:0',
        ];
    }
}

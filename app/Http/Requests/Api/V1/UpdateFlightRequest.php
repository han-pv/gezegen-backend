<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departure_airport_id' => 'sometimes|exists:airports,id',
            'arrival_airport_id'   => 'sometimes|exists:airports,id|different:departure_airport_id',
            'departure_time'       => 'sometimes|date',
            'arrival_time'         => 'sometimes|date|after:departure_time',
            'total_seats'          => 'sometimes|integer|min:1',
            'price'                => 'sometimes|numeric|min:0',
        ];
    }
}

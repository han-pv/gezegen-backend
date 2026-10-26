<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id'   => 'required|exists:airports,id|different:departure_airport_id',
            'departure_time'       => 'required|date',
            'arrival_time'         => 'required|date|after:departure_time',
            'total_seats'          => 'required|integer|min:1',
            'available_seats'      => 'required|integer|min:0',
            'price'                => 'required|numeric|min:0',
        ];
    }
}

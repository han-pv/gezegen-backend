<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FlightStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from_city_id'  => ['required', 'exists:cities,id'],
            'to_city_id'    => ['required', 'exists:cities,id', 'different:from_city_id'],
            'airplane_id'   => ['required', 'exists:airplanes,id'],
            'flight_number' => ['required', 'string', 'max:10'],
            'departure_at'  => ['required', 'date', 'after:now'],
            'arrival_at'    => ['required', 'date', 'after:departure_at'],
            'price'         => ['required', 'numeric', 'min:0', 'max:99999999'],
            'active'        => ['sometimes', 'boolean'],
        ];
    }
}

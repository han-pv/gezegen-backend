<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FlightUpdateRequest extends FormRequest
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
            'from_city_id' => ['sometimes', 'integer', 'exists:cities,id'],
            'to_city_id' => ['sometimes', 'integer', 'exists:cities,id'],
            'from_time' => ['sometimes', 'date'],
            'to_time' => ['sometimes', 'date'],
            'code' => ['sometimes', 'string', 'max:255'],
            'airlines' => ['sometimes', 'string', 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FlightIndexRequest extends FormRequest
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
            'from'       => ['nullable', 'integer', 'exists:cities,id'],
            'to'         => ['nullable', 'integer', 'exists:cities,id', 'different:from'],
            'date'       => ['nullable', 'date_format:Y-m-d', 'after_or_equal:today'],
            'passengers' => ['nullable', 'integer', 'min:1', 'max:9'],
            'page'       => ['nullable', 'integer', 'min:1'],
            'per_page'   => ['nullable', 'integer', 'min:1', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'to.different'          => 'The destination city cannot be the same as the departure city.',
            'date.after_or_equal'   => 'You cannot select a date in the past.',
        ];
    }
}

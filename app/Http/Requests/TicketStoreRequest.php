<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TicketStoreRequest extends FormRequest
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
        'flight_id'               => ['required', 'integer', 'exists:flights,id'],
        'passengers'              => ['required', 'array', 'min:1', 'max:9'],
        'passengers.*.first_name' => ['required', 'string', 'max:100'],
        'passengers.*.last_name'  => ['required', 'string', 'max:100'],
        'passengers.*.age'        => ['required', 'integer', 'min:0', 'max:120'],
        'passengers.*.phone'      => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]+$/'],
    ];
}

public function messages(): array
{
    return [
        'flight_id.exists'             => 'Flight not found.',
        'passengers.required'          => 'Min 1 Passenger.',
        'passengers.max'               => 'Max 9 Passenger.',
        'passengers.*.first_name.required' => 'Enter your firstname.',
        'passengers.*.last_name.required'  => 'Enter your lastname.',
        'passengers.*.age.required'    => 'Enter your age.',
        'passengers.*.phone.required'  => 'Enter your phone number.',
        'passengers.*.phone.regex'     => 'Invalid phone number.',
    ];
}

public function after(): array
{
    return [
        function (Validator $validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $hasAdult = collect($this->input('passengers', []))
                ->contains(fn ($p) => (int) ($p['age'] ?? 0) >= 18);

            if (! $hasAdult) {
                $validator->errors()->add(
                    'passengers',
                    'To purchase a ticket, at least one passenger must be over 18 years old.'
                );
            }
        },
    ];
}
}

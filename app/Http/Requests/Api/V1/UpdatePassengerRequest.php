<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePassengerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'      => 'sometimes|string',
            'last_name'       => 'sometimes|string',
            'email'           => 'sometimes|email|unique:passengers,email,' . $this->route('passenger'),
            'phone'           => 'nullable|string',
            'passport_number' => 'sometimes|string|unique:passengers,passport_number,' . $this->route('passenger'),
            'date_of_birth'   => 'sometimes|date',
        ];
    }
}

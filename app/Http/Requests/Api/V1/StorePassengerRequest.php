<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePassengerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'email'           => 'required|email|unique:passengers',
            'phone'           => 'nullable|string',
            'passport_number' => 'required|string|unique:passengers',
            'date_of_birth'   => 'required|date',
        ];
    }
}

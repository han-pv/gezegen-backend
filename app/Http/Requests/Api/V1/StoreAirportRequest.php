<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAirportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string',
            'code'    => 'required|string|size:3|unique:airports',
            'city'    => 'required|string',
            'country' => 'required|string',
        ];
    }
}

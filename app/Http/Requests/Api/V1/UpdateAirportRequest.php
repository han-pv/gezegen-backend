<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAirportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'sometimes|string',
            'code'    => 'sometimes|string|size:3|unique:airports,code,' . $this->route('airport'),
            'city'    => 'sometimes|string',
            'country' => 'sometimes|string',
        ];
    }
}

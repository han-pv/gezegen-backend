<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AirplaneStoreRequest extends FormRequest
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
            'airline'             => ['required', 'string', 'max:100'],
            'model'               => ['required', 'string', 'max:100'],
            'registration_number' => ['required', 'string', 'max:20', 'unique:airplanes,registration_number'],
            'capacity'            => ['required', 'integer', 'min:1', 'max:900'],
            'active'              => ['sometimes', 'boolean'],
        ];
    }
}

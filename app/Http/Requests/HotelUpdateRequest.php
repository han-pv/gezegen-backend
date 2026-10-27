<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HotelUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $hotelId = $this->route('hotel')->id ?? $this->hotel;
        return [
            'city_id' => 'required|integer|exists:cities,id',
            'name' => 'required|string|max:255|unique:hotels,name' . $hotelId,
            'slug' => 'required|string|unique:hotels,slug' . $this->route('id'),
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'required|string',
            'image' => 'required|string',
            'active' => 'required|boolean',
        ];
    }
}

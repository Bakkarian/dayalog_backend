<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'vin' => 'required|string|unique:vehicles',
            'number_plate' => 'required|string|unique:vehicles',
            'make' => 'required|string',
            'model' => 'required|string',

            'availability' => 'boolean',
            'capacity_weight' => 'required|numeric',
            'capacity_volume' => 'required|numeric',

            'insurance_policy_number' => 'nullable|string',
            'insurance_coverage' => 'nullable|string',
            'insurance_expiration' => 'nullable|date',

            'attached_device_id' =>'integer'
        ];
    }
}

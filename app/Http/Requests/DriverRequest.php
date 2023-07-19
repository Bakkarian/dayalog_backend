<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'license' => [''] ,
            'user_id' => [
                'required_without_all:email,patasente_id,phone_number',
                 'exists:users,id',
                 'unique:drivers,user_id'
            ],
            'name' => ['required_if:user_id,null'],
            'email' => ['required_without_all:user_id,patasente_id,phone_number'],
            'patasente_id' => ['required_without_all:user_id,email,phone_number'],
            'phone_number' => ['required_without_all:user_id,email,patasente_id']

        ];
    }
}

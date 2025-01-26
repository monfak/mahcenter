<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'nullable',
            'last_name'     => 'nullable',
            'role'          => 'nullable|exists:roles,id',
            'email'         => 'nullable|unique:users',
            'mobile'        => 'required|unique:users',
            'national_code' => 'nullable|numeric|unique:users',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

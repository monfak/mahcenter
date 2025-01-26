<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'email'         => 'nullable|unique:users,id,' . $this->id,
            'mobile'        => 'required|unique:users,id,' . $this->id,
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

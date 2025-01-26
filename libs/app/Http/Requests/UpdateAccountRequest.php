<?php

namespace App\Http\Requests;

use App\Rules\Mobile;
use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required', 'string', 'max:191',
            'last_name'     => 'required', 'string', 'max:191',
            'email'         => 'nullable', 'string', 'email', 'max:255', 'unique:users,id,' . $this->id,
            'mobile' => [
                'required',
                'numeric',
                'unique:users,id,' . $this->id,
                new Mobile,
            ],
            'national_code' => [
                'nullable',
                'numeric',
                'unique:users',
                new NationalCode,
            ],
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'option_name'       => 'required',
            'option_sort_order' => 'integer|nullable',
            'name.*'            => 'required',
            'sort_order.*'      => 'integer|nullable',
            'image.*'           => 'image|mimes:jpg,png,jpeg,gif',
        ];
    }
}

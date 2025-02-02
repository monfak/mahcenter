<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryMethodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|max:191',
            'price'                 => 'nullable|numeric',
            'in_city_price'         => 'nullable|numeric',
            'small_floor_price'     => 'nullable|numeric',
            'big_floor_price'       => 'nullable|numeric',
            'content'               => 'nullable|string',
            'has_carrige_forward'   => 'nullable|in:0,1',
            'is_cover_all'          => 'nullable|in:0,1',
            'is_active'             => 'nullable|in:0,1',
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

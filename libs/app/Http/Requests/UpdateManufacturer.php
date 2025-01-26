<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManufacturer extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:191',
            'slug'          => 'required|max:191|alpha_dash|unique:manufacturers,id,' . $this->id,
            'logo'          => 'image|mimes:jpg,png,jpeg,gif,webp',
            'sort_order'    => 'nullable|numeric|min:0,max:255',
            'description'   => 'string|nullable',
            'title'             => 'string|nullable',
            'meta_description'  => 'string|nullable',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarrantyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => 'required|max:255',
            'image'         => 'image|mimes:jpg,png,jpeg,gif,webp',
            'content'       => 'nullable',
            'title'         => 'nullable|max:255',
            'description'   => 'nullable',
            'is_active'     => 'required|in:0,1',
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['slug'] = 'required|max:255|alpha_dash|unique:warranties';
                break;
            case 'PATCH':
            case 'PUT':
                $rules['slug'] = 'required|max:255|alpha_dash|unique:warranties,id,' . $this->id;
                break;
        }
        return $rules;
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

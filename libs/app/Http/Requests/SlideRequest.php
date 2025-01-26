<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
        $rules = [
            'heading'       => 'nullable|max:191|string',
            'alt'           => 'nullable|max:191|string',
            'url'           => 'nullable|max:191|string',
            'content'       => 'nullable',
            'sort_order'    => 'nullable|numeric|min:0,max:255',
            'status'        => 'in:0,1',
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['image'] =  'required|image|mimes:jpg,png,jpeg,gif,svg';
                break;
            case 'PATCH':
            case 'PUT':
                $rules['image'] = 'nullable|image|mimes:jpg,png,jpeg,gif,svg';
                break;
        }
        return $rules;
    }
}

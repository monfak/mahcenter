<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuItemRequest extends FormRequest
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
            'heading'               => 'required|string',
            'label'                 => 'nullable|string',
            'url'                   => 'nullable|max:191',
            'image'                 => 'image|mimes:jpg,png,jpeg,gif',
            'parent_id'             => 'nullable|exists:menu_items,id',
            'sort_order'            => 'nullable|numeric|min:0,max:255',
            'status'                => 'nullable|in:0,1',
        ];
        return $rules;
    }
}

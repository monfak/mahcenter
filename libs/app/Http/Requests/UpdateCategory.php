<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:191',
            'slug'              => 'required|max:191|alpha_dash|unique:categories,id,' . $this->id,
            'image'             => 'image|mimes:jpg,png,jpeg,gif',
            'remove_image'      => 'Nullable|in:0,1,on',
            'content'           => 'Nullable',
            'title'             => 'required|max:191',
            'meta_keywords'     => 'Nullable',
            'meta_description'  => 'Nullable',
            'parent_id'         => 'Nullable|exists:categories,id',
            'sort_order'        => 'Nullable|Numeric|Min:0,Max:255',
            'discount'          => 'Nullable|Numeric|Min:0,Max:100',
            'has_slider'        => 'in:0,1',
            'status'            => 'required|in:0,1',
            'filter_id.*'       => 'exists:filter_groups,id',
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

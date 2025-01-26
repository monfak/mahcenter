<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleCategory extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|max:191',
            'slug'         => 'required|alpha_dash|unique:article_categories|max:191',
            'parent_id'    => 'nullable|exists:article_categories,id',
            'image'        => 'nullable|mimes:jpg,png,jpeg,gif|max:4096',
            'description'  => 'nullable',
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

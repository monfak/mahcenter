<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleCategory extends FormRequest
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
            'slug'          => 'required|max:191|alpha_dash|unique:article_categories,id,' . $this->id,
            'description'   => 'nullable|max:300',
            'image'         => 'nullable|mimes:jpg,png,jpeg,gif|max:4096',
            'parent_id'     => 'nullable|exists:article_categories,id',
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

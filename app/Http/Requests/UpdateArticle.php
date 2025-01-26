<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticle extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'             => 'required|max:191',
            'slug'              => 'required|max:191|alpha_dash|unique:articles,id,' . $this->id,
            'image'             => 'image|mimes:jpg,png,jpeg,gif,webp',
            'content'           => 'Nullable',
            'category_id'       => 'required',
            'meta_keywords'     => 'Nullable',
            'meta_description'  => 'Nullable',
            'og_image'              => 'image|mimes:jpg,png,jpeg,gif,webp',
            'twitter_title'         => 'nullable|string',
            'twitter_description'   => 'nullable|string',
            'twitter_image'         => 'image|mimes:jpg,png,jpeg,gif,webp',
            'meta_title'            => 'nullable|string',
            'canonical'             => 'nullable|string',
            'status'            => 'required|in:0,1',
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

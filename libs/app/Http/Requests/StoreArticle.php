<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticle extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                 => 'required|max:191',
            'slug'                  => 'required|max:191|alpha_dash|unique:articles',
            'image'                 => 'image|mimes:jpg,png,jpeg,gif,webp',
            'content'               => 'nullable',
            'category_id'           => 'required',
            'meta_keywords'         => 'nullable',
            'meta_description'      => 'nullable',
            'og_image'              => 'image|mimes:jpg,png,jpeg,gif,webp',
            'twitter_title'         => 'nullable|string',
            'twitter_description'   => 'nullable|string',
            'twitter_image'         => 'image|mimes:jpg,png,jpeg,gif,webp',
            'meta_title'            => 'nullable|string',
            'canonical'             => 'nullable|string',
            'status'                => 'required|in:0,1',
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

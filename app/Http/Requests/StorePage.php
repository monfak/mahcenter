<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePage extends FormRequest
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
            'slug'              => 'required|max:191|alpha_dash|unique:pages',
            'image'             => 'image|mimes:jpg,png,jpeg,gif,webp',
            'content'           => 'Nullable',
            'meta_keywords'     => 'Nullable',
            'meta_description'  => 'Nullable',
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

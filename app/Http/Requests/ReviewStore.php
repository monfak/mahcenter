<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStore extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|min:3|max:100',
            'email'         => 'required|email',
            'title'         => 'required_with:answer_to|max:100',
            'content'       => 'required',
            'answer_to'     => 'Nullable|exists:reviews,id',
            'product_id'    => 'required|exists:products,id',
            'rating'        => 'Nullable|in:1,2,3,4,5',
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

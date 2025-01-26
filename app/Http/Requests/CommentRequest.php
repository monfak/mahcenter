<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'content'       => 'required',
            'answer_to'     => 'nullable|exists:comments,id',
        ];
        if(!auth()->check()) {
            $rules['name'] = 'required|min:3|max:100';
            $rules['email'] = 'required|email';
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

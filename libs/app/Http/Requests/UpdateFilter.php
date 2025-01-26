<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFilter extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_name'        => 'required',
            'group_label'       => 'nullable',
            'group_sort_order'  => 'integer|nullable',
            'keep_filter.*'     => 'Nullable|exists:filters,id',
            'name.*'            => '',
            'order.*'           => 'integer|nullable',
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

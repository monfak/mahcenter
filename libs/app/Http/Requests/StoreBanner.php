<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBanner extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:100',
            'status'        => 'in:0,1',
            'position'      => 'Nullable',
            'width'         => 'Nullable|integer',
            'height'        => 'Nullable|integer',
            'title.*'       => 'max:191|required_without_all:url.*,image.*,content.*',
            'url.*'         => 'Nullable|url|required_without_all:title.*,image.*,content.*',
            'image.*'       => 'image|mimes:jpg,png,jpeg,gif|required_without_all:title.*,url.*,content.*',
            'content.*'     => 'Nullable|required_without_all:title.*,url.*,image.*',
            'sort_order.*'  => 'Nullable|Numeric|Min:0,Max:255',
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

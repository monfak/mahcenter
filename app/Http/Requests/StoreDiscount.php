<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscount extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:191|unique:discounts,title',
            'value' => 'required|numeric|min:1|max:99',
            'users' => 'required|in:0,1,2,3',
            'type' => 'required|in:0,1,2,3,4,5',
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'content' => 'nullable|string|max:7000',
            'customer_id' => 'nullable',
            'customer_id.*' => 'exists:users,id',
            'product_id' => 'nullable|required_if:type,1',
            'product_id.*' => 'exists:products,id',
            'category_id' => 'nullable|required_if:type,2',
            'category_id.*' => 'exists:categories,id',
            'manufacturer_id' => 'nullable|required_if:type,3',
            'manufacturer_id.*' => 'exists:manufacturers,id',
            'brand_id' => 'nullable|required_if:type,4',
            'brand_id.*' => 'exists:brands,id',
            'model_id' => 'nullable|required_if:type,5',
            'model_id.*' => 'exists:brand_models,id',
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

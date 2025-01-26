<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                          => 'required|max:191',
            'slug'                          => 'required|max:191|alpha_dash|unique:products,slug,' . $this->product->id,
            'description'                   => 'required',
            'title'                         => 'nullable|max:191',
            'meta_keywords'                 => 'Nullable',
            'meta_description'              => 'Nullable',
            'manufacturer_id'               => 'required|exists:manufacturers,id',
            'model'                         => 'required',
            'sort_order'                    => 'Nullable|Numeric|Min:0,Max:255',
            'stock'                         => 'Nullable|integer',
            'price'                         => 'required|integer',
            'is_foreign'                    => 'required|in:0,1',
            'special'                       => 'nullable|integer',
            'colleague_price'               => 'nullable|integer',
            'length'                        => 'Nullable|Numeric',
            'width'                         => 'Nullable|Numeric',
            'height'                        => 'Nullable|Numeric',
            'length_unit'                   => 'Nullable|in:metre,centimetre,milimetre,inch||required_with:length,width,height',
            'weight'                        => 'Nullable|Numeric',
            'weight_unit'                   => 'Nullable|in:kilogram,gram,lb,oz|required_with:weight',
            'src'                           => 'nullable',
            'status'                        => 'required|in:0,1',
            'suggest'                       => 'required|in:0,1',
            'giftcard'                      => 'nullable',
            'warranty'                      => 'nullable',
            'category_id.*'                 => 'exists:categories,id',
            'image'                         => 'Nullable|mimes:jpg,png,jpeg,gif,webp',
            'keep_images.*'                 => 'Nullable|exists:product_images,id',
            'keep_images_sort_order.*'      => 'Nullable|Numeric|Min:0,Max:255',
            'images.*'                      => 'Nullable|mimes:jpg,png,jpeg,gif,webp',
            'images_sort_order.*'           => 'Nullable|Numeric|Min:0,Max:255',
            'filter_id.*'                   => 'exists:filters,id',
            'attribute_id.*'                => 'exists:attributes,id',
            'attribute_value.*'             => 'Nullable',
            'option_values.*.value_id.*'    =>'required',
            'catalogue'                     => 'nullable',
            'catalogue_name'                => 'nullable',
            'og_image'                      => 'nullable|mimes:jpg,png,jpeg,gif,webp',
            'twitter_title'                 => 'nullable|string',
            'twitter_description'           => 'nullable|string',
            'twitter_image'                 => 'nullable|mimes:jpg,png,jpeg,gif,webp',
            'canonical'                     => 'nullable|string',
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

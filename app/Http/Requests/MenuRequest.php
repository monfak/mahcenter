<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => ($this->has('is_active') && $this->input('is_active')) ? 1 : 0,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'is_active' => 'required|in:0,1',
            'name' => 'nullable|string|max:255',
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['position'] = 'required|max:191|alpha_dash|unique:menus';
                break;
            case 'PATCH':
            case 'PUT':
                $rules['position'] = 'required|max:191|alpha_dash|unique:menus,id,' . $this->id;
                break;
        }
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', Rule::unique('product_lists')->ignore($this->product->id ?? 0)],
            'image' => 'required|mimes:png,jpg,jpeg',
            'sub_images.*' => 'mimes:png,jpg,jpeg',
            'short_description' => 'required|max:255',
            'long_description' => 'required',
            'product_code' => 'required|integer',
            'special_price' => 'numeric|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'size' => 'required',
            'color' => 'required',
            'remark' => 'required',
            'brand' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'category_id' => 'required|integer',
                    'subcategory_name' => 'required|unique:subcategories'
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'category_id' => 'required|integer',
                    'subcategory_name' => 'required|unique:subcategories'
                ];
        }
    }
}

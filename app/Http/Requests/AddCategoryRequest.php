<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // protected $stopOnFirstFailure = true;

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
                    'category_name' => 'required|unique:categories',
                    'category_image' => 'required|mimes:png,jpg,jpeg',
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'category_name' => 'required',
                    'category_image' => 'required|mimes:png,jpg,jpeg',
                ];
        }
    }
}

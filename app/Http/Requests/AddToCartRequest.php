<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'email' => 'required|min:5|max:60',
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|max:3 | min:1',
            'product_code' => 'required|max:15| min:3',
        ];
    }
}

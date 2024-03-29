<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FavouriteRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users'],
            'product_id' => [
                'required', 'integer',
                'exists:product_lists,id',
                Rule::unique('favourites', 'product_id')->where(function ($query) {
                    $query->where('email', $this->email);
                }),
            ],
        ];
    }
}

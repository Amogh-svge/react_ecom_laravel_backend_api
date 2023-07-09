<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'reviewer_id' =>  'required|exists:users,id',
            'product_id' =>  'required|exists:product_lists,id',
            'reviewer_name' =>  'required|string',
            'reviewer_photo' =>  'required',
            'reviewer_rating' =>  'required|integer',
            'reviewer_comment' =>  'required|string',
        ];
    }
}

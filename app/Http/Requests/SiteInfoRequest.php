<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteInfoRequest extends FormRequest
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
            'about' => 'required',
            'refund' => 'required',
            'purchase_guide' => 'required',
            'privacy' => 'required',
            'address' => 'required',
            'facebook_link' => 'required',
            'instagram_link' => 'required',
            'twitter_link' => 'required',
            'ios_app_link' => 'required',
            'android_app_link' => 'required',
            'copyright_link' => 'required',
        ];
    }
}

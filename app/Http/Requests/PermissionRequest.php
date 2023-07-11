<?php

namespace App\Http\Requests;

use App\Rules\SupportOnlyAlphabets;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                new SupportOnlyAlphabets($this),
                // $this->method() === 'POST' ? Rule::unique('permissions', 'name') : Rule::unique('permissions')->ignore($this->permission ?? 0),
            ],
        ];
    }
}

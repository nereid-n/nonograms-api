<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class NonogramRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'img' => ['required', 'image'],
            'width' => ['required', 'integer', 'between:1,100'],
            'height' => ['required', 'integer', 'between:1,100'],
            'color' => ['required', 'boolean'],
        ];
    }
}

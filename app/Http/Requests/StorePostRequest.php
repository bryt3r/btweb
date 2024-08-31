<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:55'],
            'content' => ['required', 'string',],
            'category' => ['required', 'string', 'max:15'],
            'imageFile.*' => ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
        ];
    }
}

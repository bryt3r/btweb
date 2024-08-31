<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:200'],
                'description' => ['required', 'string',],
                'condition' => ['required', 'string', 'max:15'],
                'category' => ['required', 'string', 'max:15'],
                'cost_price' => ['required', 'numeric'],
                'selling_price' => ['nullable', 'numeric'],
        ];
    }
}

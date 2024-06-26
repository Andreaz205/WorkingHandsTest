<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'links' => 'required|array|max:3',
            'links.*' => 'required|string',
            'name' =>  'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'price' => 'nullable|numeric|min:0',
        ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetApplicationListRequest extends FormRequest
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
            'sort_by_price' => 'nullable|string|in:asc,desc',
            'sort_by_date' => 'nullable|string|in:asc,desc',
        ];
    }
}

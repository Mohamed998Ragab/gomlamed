<?php

namespace App\Http\Requests\ThirdBanner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'icon' => 'sometimes|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'icon.sometimes' => 'The icon field is required.',
        ];
    }
}
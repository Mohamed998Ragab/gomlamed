<?php

namespace App\Http\Requests\FirstBanner;

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
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.sometimes' => 'The title field is required.',
            'description.sometimes' => 'The description field is required.',
        ];
    }
}
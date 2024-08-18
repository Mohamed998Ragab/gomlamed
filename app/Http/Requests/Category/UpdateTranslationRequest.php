<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTranslationRequest extends FormRequest
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
        'language_id' => [
            'required',
            Rule::exists('languages', 'id'),
            Rule::unique('category_translations')->where(function ($query) {
                return $query->where('category_id', $this->route('categoryId'))
                                ->where('id', '!=', $this->route('id'));
            })
        ],
            'name' => 'sometimes|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'language_id.sometimes' => 'The language field is required.',
            'language_id.exists' => 'The selected language does not exist.',
            'name.sometimes' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
        ];
    }
}

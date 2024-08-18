<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTranslationRequest extends FormRequest
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
    public function rules()
    {
        return [
            'language_id' => [
                'required',
                Rule::exists('languages', 'id'),
                Rule::unique('about_translations')->where(function ($query) {
                    return $query->where('about_id', $this->route('aboutId'));
                })
            ],
            'first_title' => 'required|string|max:255',
            'first_description' => 'required|string',
            'second_title' => 'required|string|max:255',
            'second_description' => 'required|string',
            'third_title' => 'required|string|max:255',
            'third_description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.required' => 'The language field is required.',
            'language_id.exists' => 'The selected language does not exist.',
            'first_title.required' => 'The first title field is required.',
            'first_title.max' => 'The first title may not be greater than 255 characters.',
            'first_description.required' => 'The first description field is required.',
            'second_title.required' => 'The second title field is required.',
            'second_title.max' => 'The second title may not be greater than 255 characters.',
            'second_description.required' => 'The second description field is required.',
            'third_title.required' => 'The third title field is required.',
            'third_title.max' => 'The third title may not be greater than 255 characters.',
            'third_description.required' => 'The third description field is required.',
        ];
    }
}

<?php

namespace App\Http\Requests\Slider;

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
    public function rules(): array
    {
        return [
            'language_id' => [
                'required',
                Rule::exists('languages', 'id'),
                Rule::unique('slider_translations')->where(function ($query) {
                    return $query->where('slider_id', $this->route('sliderId'));
                })
            ],
            
            'title' => 'required|string|max:255',
            'second_title' => 'required|string|max:255',
            'description' => 'required|string|',

        ];
    }

    public function messages()
    {
        return [
            'language_id.required' => 'The language field is required.',
            'language_id.exists' => 'The selected language does not exist.',
            'title.required' => 'The name field is required.',
            'title.string' => 'The name must be a string.',
            'title.max' => 'The name may not be greater than 255 characters.',
        ];
    }
}

<?php

namespace App\Http\Requests\Product;

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
                Rule::unique('product_translations')->where(function ($query) {
                    return $query->where('product_id', $this->route('productId'));
                })
            ],
            
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'language_id.required' => 'The language field is required.',
            'language_id.exists' => 'The selected language does not exist.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }
}

<?php

namespace App\Http\Requests\FirstBanner;

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
               Rule::unique('first_banner_translations')->where(function ($query) {
                   return $query->where('first_banner_id', $this->route('firstBannerId'))
                                ->where('id', '!=', $this->route('id'));
               })
           ],
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'language_id.sometimes' => 'The language field is required.',
            'language_id.exists' => 'The selected language does not exist.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 500 characters.',
        ];
    }
}

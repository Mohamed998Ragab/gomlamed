<?php

namespace App\Http\Requests\About;

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
               'sometimes',
               Rule::exists('languages', 'id'),
               Rule::unique('about_translations')->where(function ($query) {
                   return $query->where('about_id', $this->route('aboutId'))
                                ->where('id', '!=', $this->route('id'));
               })
           ],
           'first_title' => 'sometimes|string|max:255',
           'first_description' => 'sometimes|string',
           'second_title' => 'sometimes|string|max:255',
           'second_description' => 'sometimes|string',
           'third_title' => 'sometimes|string|max:255',
           'third_description' => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'language_id.exists' => 'The selected language does not exist.',

            'first_title.sometimes' => 'The first title field is required.',
            'first_title.max' => 'The first title may not be greater than 255 characters.',
            'first_description.sometimes' => 'The first description field is required.',
            'second_title.sometimes' => 'The second title field is required.',
            'second_title.max' => 'The second title may not be greater than 255 characters.',
            'second_description.sometimes' => 'The second description field is required.',
            'third_title.sometimes' => 'The third title field is required.',
            'third_title.max' => 'The third title may not be greater than 255 characters.',
            'third_description.sometimes' => 'The third description field is required.',
            'image.sometimes' => 'An image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }
}

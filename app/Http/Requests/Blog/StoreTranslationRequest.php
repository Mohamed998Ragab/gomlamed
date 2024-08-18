<?php

namespace App\Http\Requests\Blog;

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
                Rule::unique('blog_translations')->where(function ($query) {
                    return $query->where('blog_id', $this->route('blogId'));
                })
            ],
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}

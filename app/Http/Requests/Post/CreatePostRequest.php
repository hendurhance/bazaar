<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required', 'string'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
            'tags' => ['required', 'array', 'min:1'],
            'tags.*' => ['required', 'integer', 'exists:tags,id'],
            'published' => ['required', 'in:published,draft'],
        ];
    }
}

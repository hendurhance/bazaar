<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'category' => ['required', 'exists:categories,slug'],
            'subcategory' => ['nullable', 'exists:categories,slug'],
            'price' => ['required', 'numeric', 'min:0'],
            'start_date' => ['required', 'date', 'after:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'is_negotiable' => ['nullable', 'boolean'],
            'video_url' => ['nullable', 'url', 'active_url'],
            'images' => ['required', 'array', 'max:5'],
            'images.*' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png'],
            'country' => ['required', 'exists:countries,iso2'],
            'state' => ['required', 'exists:states,code'],
            'city' => ['nullable', 'string'],
            'seller_name' => ['required', 'string', 'max:255'],
            'seller_email' => ['required', 'email', 'max:255'],
            'seller_mobile' => ['required', 'string', 'max:15', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'seller_address' => ['required', 'string', 'max:255'],
            'terms' => ['required', 'accepted'],
        ];
    }
}

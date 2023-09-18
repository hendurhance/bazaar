<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'min:10'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'video_url' => ['nullable', 'url', 'active_url'],
            'seller_name' => ['nullable', 'string', 'max:255'],
            'seller_mobile' => ['nullable', 'string', 'max:15', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'seller_address' => ['nullable', 'string', 'max:255'],
        ];
    }
}

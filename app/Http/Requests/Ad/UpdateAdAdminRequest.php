<?php

namespace App\Http\Requests\Ad;

use App\Enums\AdStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAdAdminRequest extends FormRequest
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
            'category' => ['nullable', 'exists:categories,slug'],
            'subcategory' => ['nullable', 'exists:categories,slug'],
            'start_date' => ['nullable', 'date', 'after:today'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'seller_mobile' => ['nullable', 'string', 'max:15', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'seller_address' => ['nullable', 'string', 'max:255'],
            'seller_name' => ['nullable', 'string', 'max:255'],
            'seller_email' => ['nullable', 'string', 'email', 'max:255'],
            'status' => ['nullable', new Enum(AdStatus::class)]
        ];
    }
}

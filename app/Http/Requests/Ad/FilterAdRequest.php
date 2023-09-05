<?php

namespace App\Http\Requests\Ad;

use App\Enums\PriceRange;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterAdRequest extends FormRequest
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
            'category' => 'nullable|exists:categories,slug',
            'country' => 'nullable|exists:countries,iso2',
            'price_range' => ['nullable', new Enum(PriceRange::class)],
            'search' => 'nullable|string|max:255',
        ];
    }
}

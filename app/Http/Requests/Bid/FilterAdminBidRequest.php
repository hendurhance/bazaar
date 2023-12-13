<?php

namespace App\Http\Requests\Bid;

use App\Enums\PriceRange;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterAdminBidRequest extends FormRequest
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
            'accepted' => ['nullable', 'in:accepted,rejected,pending'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'bid_id' => ['nullable', 'string', 'uuid'],
            'price_range' => ['nullable', new Enum(PriceRange::class)]
        ];
    }
}

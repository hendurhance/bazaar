<?php

namespace App\Http\Requests\Payment;

use App\Enums\PaymentGateway;
use App\Enums\PriceRange;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterAdminPaymentRequest extends FormRequest
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
            'search' => 'nullable|string',
            'price_range' => ['nullable', new Enum(PriceRange::class)],
            'gateway' => ['nullable', new Enum(PaymentGateway::class)],
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
        ];
    }
}

<?php

namespace App\Http\Requests\Payment;

use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterUserPaymentRequest extends FormRequest
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
            'status' => ['nullable', new Enum(PaymentStatus::class)],
            'gateway' => ['nullable', new Enum(PaymentGateway::class)],
        ];
    }
}

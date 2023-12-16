<?php

namespace App\Http\Requests\Payout;

use App\Enums\PayoutGateway;
use App\Enums\PayoutStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FilterUserPayoutRequest extends FormRequest
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
            'status' => ['nullable', new Enum(PayoutStatus::class)],
            'gateway' => ['nullable', new Enum(PayoutGateway::class)],
        ];
    }
}

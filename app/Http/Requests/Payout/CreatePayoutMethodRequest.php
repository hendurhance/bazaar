<?php

namespace App\Http\Requests\Payout;

use App\Services\Payout\BankCodeService;
use Illuminate\Foundation\Http\FormRequest;

class CreatePayoutMethodRequest extends FormRequest
{
    /**
     * Instantiate new request instance
     */
    public function __construct(protected BankCodeService $bankCodeService)
    {
    }

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
            'bank_code' => ['required', 'string', 'in:'.$this->bankCodeService->listAllBanksCode()],
            'account_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255'],
        ];
    }
}

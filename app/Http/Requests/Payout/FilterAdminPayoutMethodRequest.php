<?php

namespace App\Http\Requests\Payout;

use App\Services\Payout\BankCodeService;
use Illuminate\Foundation\Http\FormRequest;

class FilterAdminPayoutMethodRequest extends FormRequest
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
            'country_id' => 'nullable|exists:countries,id',
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'bank_code' => ['nullable', 'string', 'in:'.$this->bankCodeService->listAllBanksCode()],
            'user_id' => ['nullable', 'exists:users,id'],
        ];
    }
}

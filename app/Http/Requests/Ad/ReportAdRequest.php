<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class ReportAdRequest extends FormRequest
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
            'reason' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'terms' => 'required|accepted',
            // 'g-recaptcha-response' => 'recaptcha',
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Traits\PasswordEnvironments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class ResetPasswordRequest extends FormRequest
{
    use PasswordEnvironments;
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
            'token' => 'required|string',
            'password' => [...$this->passwordRules(app()->environment()), 'confirmed'],
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Rules\Username;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255', 'min:2'],
            'last_name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'username' => ['required', 'unique:users,username', new Username()],
            'password' => $this->passwordRules(app()->environment()),
            'terms' => 'required|accepted',
        ];
    }

    /**
     * Get password rules for environment.
     * 
     * @param string $environment
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    protected function passwordRules(string $environment)
    {
        return match ($environment) {
            'production' => [
                'required',
                'string',
                Password::min(8)     // must be at least 8 characters in length
                    ->mixedCase()     // must contain both uppercase and lowercase letters
                    ->letters()       // must contain at least one letter
                    ->numbers()       // must contain at least one digit
                    ->symbols()       // must contain at least one special character
                    ->uncompromised(), // must not be compromised in a data breach
            ],
            default => [
                'string',
                Password::min(8)     // must be at least 8 characters in length
            ],
        };
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'The email is not available.',
            'username.unique' => 'The username is not available.',
        ];
    }
}

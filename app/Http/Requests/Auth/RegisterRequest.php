<?php

namespace App\Http\Requests\Auth;

use App\Rules\Username;
use App\Traits\PasswordEnvironments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255', 'min:2'],
            'last_name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'username' => ['required', 'unique:users,username', new Username()],
            'password' => $this->passwordRules(app()->environment()),
            'terms' => 'required|accepted',
        ];
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

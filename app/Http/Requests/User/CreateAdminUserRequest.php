<?php

namespace App\Http\Requests\User;

use App\Enums\Gender;
use App\Rules\Username;
use App\Traits\PasswordEnvironments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateAdminUserRequest extends FormRequest
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
            'last_name'  => ['required', 'string', 'max:255', 'min:2'],
            'email'      => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'username'   => ['required', 'unique:users,username',  new Username()],
            'mobile'     => ['required', 'unique:users,mobile'],
            'address'    => ['required', 'max:255'],
            'country'    => ['required', 'exists:countries,iso2'],
            'state'      => ['required', 'exists:states,code'],
            'city'       => ['required', 'exists:cities,id'],
            'zip_code'   => ['required', 'max:20'],
            'gender'     => ['required', new Enum(Gender::class)],
            'is_active'  => ['required', 'boolean'],
            'password'   => $this->passwordRules(app()->environment()),
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}

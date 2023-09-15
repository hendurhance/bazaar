<?php

namespace App\Traits;

use Illuminate\Validation\Rules\Password;

trait PasswordEnvironments
{
    /**
     * Get password rules for environment.
     * 
     * @param string $environment
     * @param bool $shouldRequire
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    protected function passwordRules(string $environment, bool $shouldRequire = true): array
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
                $shouldRequire ? 'required' : 'nullable',
                'string',
                Password::min(8)     // must be at least 8 characters in length
            ],
        };
    }
}

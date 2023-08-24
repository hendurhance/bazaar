<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Username implements ValidationRule
{
    /**
     * The minimum size of the username.
     *
     * @var int
     */
    protected $min = 3;

    /**
     * If the username requires at least one letter.
     *
     * @var bool
     */
    protected $letters = false;

    /**
     * If the username requires at least one number.
     *
     * @var bool
     */
    protected $numbers = false;

    /**
     * Allowed username symbols.
     * 
     * @var array<string>
     */
    protected array $symbols = [
        '_',
    ];

    /**
     * Username reserved words.
     * 
     * @var array<string>
     */
    protected $reserved = [
        'admin',
        'administrator',
        'moderator',
        'mod',
        'superuser',
        'super',
        'root',
        'sysadmin',
        'system',
        'help',
        'support',
        'info',
        'contact',
        'home',
        'about',
        'terms',
        'privacy',
        'faq',
        'blog',
        'blogging',
        'guest',
        'user',
        'profile',
        'account',
        'signup',
        'login',
        'signin',
        'demo',
        'download',
    ];



    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array(strtolower($value), $this->reserved)) {
            $fail("The {$attribute} is not allowed.");
        }

        if (strlen($value) < $this->min) {
            $fail("The {$attribute} must be at least {$this->min} characters.");
        }

        if ($this->letters && !preg_match('/[a-zA-Z]/', $value)) {
            $fail("The {$attribute} must contain at least one letter.");
        }

        if ($this->numbers && !preg_match('/[0-9]/', $value)) {
            $fail("The {$attribute} must contain at least one number.");
        }

        if (!preg_match('/^[a-zA-Z0-9' . implode('', $this->symbols) . ']+$/', $value)) {
            $fail("The {$attribute} may only contain letters, numbers, and symbols: " . implode('', $this->symbols));
        }
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class AuthenticateException extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message;

    /**
     * Instantiate a new exception instance.
     */
    public function __construct(string $message = 'You must be logged in to access this page.')
    {
        $this->message = $message;
    }

    /**
     * Render the exception into an HTTP response.
     * 
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        return redirect()->back()->with('error', $this->message);
    }

    /**
     * Report the exception.
     * 
     * @return bool
     */
    public function report(): bool
    {
        return false;
    }
}

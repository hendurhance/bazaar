<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class PayoutException extends Exception
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
    public function __construct(string $message = 'An error occurred while processing your payout', string $payout = null)
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
        return redirect()->route('user.payouts')->with('error', $this->message);
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

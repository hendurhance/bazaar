<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class PayoutMethodException extends Exception
{
     /**
     * The exception message.
     *
     * @var string
     */
    protected $message;

    /**
     * The payout method.
     *
     * @var string
     */
    protected $payoutMethod;

    /**
     * Instantiate a new exception instance.
     */
    public function __construct(string $message = 'An error occurred while processing your payout method', string $payoutMethod = null)
    {
        $this->message = $message;
        $this->payoutMethod = $payoutMethod;
    }

    /**
     * Render the exception into an HTTP response.
     * 
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        if (!$this->payoutMethod) {
            return redirect()->route('user.payout-methods.index')->with('error', $this->message);
        }
       return redirect()->route('user.payout-methods.create')->with('error', $this->message)->withErrors('bank_code', $this->message);
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

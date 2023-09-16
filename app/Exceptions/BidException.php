<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class BidException extends Exception
{
     /**
     * The exception message.
     *
     * @var string
     */
    protected $message;

    /**
     * The ad slug.
     *
     * @var string
     */
    protected $adSlug;

    /**
     * Instantiate a new exception instance.
     */
    public function __construct(string $message = 'Your bid could not be placed.',string $adSlug)
    {
        $this->message = $message;
        $this->adSlug = $adSlug;
    }

    /**
     * Render the exception into an HTTP response.
     * 
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        return redirect()->route('auction-details', $this->adSlug)->with('error', $this->message)->withErrors(['amount' => $this->message]);
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

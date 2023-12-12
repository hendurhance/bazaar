<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class MediaException extends Exception
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
    public function __construct(string $message = 'Uploading message failed.')
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


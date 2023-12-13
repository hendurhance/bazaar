<?php

namespace App\Traits;

trait HasVerifiedEmail
{
    /**
     * Has verified email.
     * 
     * @return bool
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null && $this->email_verification_token === null;
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'email_verification_token' => null,
        ])->save();
    }
}
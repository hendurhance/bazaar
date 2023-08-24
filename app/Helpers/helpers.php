<?php

/**
 * Generate verify token.
 * @param string $email
 * @return string
 */
if(!function_exists('generate_verify_token')) {
    function generate_verify_token(string $email): string
    {
        return bin2hex(random_bytes(32).$email.time());
    }
}

/**
 * Generate password reset token.
 * @param string $email
 * @return string
 */
if(!function_exists('generate_password_reset_token')) {
    function generate_password_reset_token(string $email): string
    {
        return hash_hmac('sha256', bin2hex(random_bytes(32).$email.time()), config('app.key'));
    }
}
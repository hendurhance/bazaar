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
<?php

/**
 * Generate verify token.
 * @param string $email
 * @return string
 */
if (!function_exists('generate_verify_token')) {
    function generate_verify_token(string $email): string
    {
        return bin2hex(random_bytes(32) . $email . time());
    }
}

/**
 * Generate password reset token.
 * @param string $email
 * @return string
 */
if (!function_exists('generate_password_reset_token')) {
    function generate_password_reset_token(string $email): string
    {
        return hash_hmac('sha256', bin2hex(random_bytes(32) . $email . time()), config('app.key'));
    }
}

/**
 * Generate a color
 * @param string $type <hex|rgba>
 * @return string
 */
if (!function_exists('generate_color')) {
    function generate_color(string $type = 'hex'): string
    {
        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

        if ($type === 'rgba') {
            $color = hex2rgba($color);
        }

        return $color;
    }
}

/**
 * Convert hex to rgba
 * @param string $hex
 * @param float $alpha
 * @return string
 */
if (!function_exists('hex2rgba')) {
    function hex2rgba(string $hex, float $alpha = 1): string
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        $rgb = [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2))
        ];

        return 'rgba(' . implode(',', $rgb) . ',' . $alpha . ')';
    }
}
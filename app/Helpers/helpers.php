<?php
/* ==========================================================================
 * This file contains all the helper functions used in the application.
 * ========================================================================== */

use App\Services\Avatar\BoringAvatar;




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

/**
 * Remove special characters from a string.
 * @param string $string
 * @return string
 */
if (!function_exists('remove_special_chars')) {
    function remove_special_chars(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}

/**
 * Sanitize html from form inputs
 * @param string $html
 * @return string
 */
if (!function_exists('sanitize_html')) {
    function sanitize_html(string $html): string
    {
        return htmlspecialchars($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}

/**
 * Convert html to CKEditor format
 * @param string $html
 * @return string
 */
if (!function_exists('html_to_ckeditor')) {
    function html_to_ckeditor(string $html): string
    {
        return str_replace(['<p>', '</p>'], '', $html);
    }
}

/**
 * Get random dicebear avatar
 * @return string
 */
if (!function_exists('get_random_avatar')) {
    function get_random_avatar(): string
    {
        $randomNames = [
            'Alice',
            'Bob',
            'Charlie',
            'David',
            'Eva',
            'Frank',
            'Grace',
            'Helen',
            'Ivy',
            'Jack',
            'Kate',
            'Liam',
            'Mia',
            'Noah',
            'Olivia',
            'Parker',
            'Quinn',
            'Ryan',
            'Sophia',
            'Tom',
            'Uma',
            'Violet',
            'William',
            'Xander',
            'Yara',
            'Zane',
        ];
        
        // Access a random name from the array
        $randomName = $randomNames[array_rand($randomNames)];
        $boringAvatar = new BoringAvatar($randomName);
        $boringAvatar->setVariant('beam')->generate();
        return $boringAvatar->getUrl();
    }
}

/**
 * Shorten title
 * @param string $title
 * @param int $limit
 * @return string
 */
if (!function_exists('shorten_characters')) {
    function shorten_characters(string $title, int $limit = 30, bool $isHTML = false): string
    {
        if ($isHTML) {
            $title = strip_tags($title);
        }
        return strlen($title) > $limit ? substr($title, 0, $limit) . '...' : $title;
    }
}

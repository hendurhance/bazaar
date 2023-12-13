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
 * Generate Transaction ID.
 * @param string $prefix
 * @return string
 */
if (!function_exists('generate_txn_id')) {
    function generate_txn_id(string $prefix = 'TXN'): string
    {
        return $prefix . '-' . time() . '-' . bin2hex(random_bytes(4));
    }
}

/**
 * Generate Payout Token.
 * @param string $prefix
 * @return string
 */
if (!function_exists('generate_payout_token')) {
    function generate_payout_token(string $prefix = 'PYT'): string
    {
        return $prefix . '-' . uniqid() . '-' . random_int(1000, 9999);
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
 * Money format
 * @param float $amount
 * @return string
 */
if (!function_exists('money')) {
    function money(float $amount, bool $withSuffix = false): string
    {
        $defaultCurrency = config('payment.currencies.default');
        $currency = config("payment.currencies.$defaultCurrency.symbol");

        $suffixes = ["", "K", "M", "B", "T"];
        $suffixIndex = 0;
        if ($withSuffix) {
            while ($amount >= 1000) {
                $suffixIndex++;
                $amount /= 1000;
            }
        }

        return match ($withSuffix) {
            true => $currency . ' ' . number_format($amount, 2) . $suffixes[$suffixIndex],
            default => $currency . ' ' . number_format($amount, 2),
        };
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
if (!function_exists('shorten_chars')) {
    function shorten_chars(string $title, int $limit = 30, bool $isHTML = false): string
    {
        if ($isHTML) {
            $title = strip_tags($title);
        }
        return strlen($title) > $limit ? substr($title, 0, $limit) . '...' : $title;
    }
}

/**
 * Mask characters
 * @param string $string
 * @param int $start
 * @param int $end
 */
if (!function_exists('mask_chars')) {
    function mask_chars(string $string, int $start = 0, int $end = 0): string
    {
        $masked = substr($string, $start, strlen($string) - $end);
        $masked = str_repeat('*', strlen($masked));
        return substr_replace($string, $masked, $start, strlen($string) - $end);
    }
}

/**
 * Sort Query Parser
 * @param string $sort
 * @return array
 */
if (!function_exists('sort_query_parser')) {
    function sort_query_parser(string $sort): array
    {
        $query = [
            'created+asc' => ['created_at', 'asc'],
            'created+desc' => ['created_at', 'desc'],
            'amount+asc' => ['amount', 'asc'],
            'amount+desc' => ['amount', 'desc'],
            'start+asc' => ['started_at', 'asc'],
            'start+desc' => ['started_at', 'desc'],
            'end+asc' => ['expired_at', 'asc'],
            'end+desc' => ['expired_at', 'desc'],
        ];
        $sort = urldecode($sort);
        return $query[$sort] ?? $query['created+desc'];
    }
}


/**
 * Convert bytes to human readable format
 * @param string $bytes
 * @param int $precision = 2
 * @return string
 */
if (!function_exists('bytes_to_human')) {
    function bytes_to_human(string $bytes, int $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');

        $bytes = max($bytes, 0);
        $unitIndex = floor(log($bytes) / log(1000));
        $unitName = $units[$unitIndex];

        return @number_format($bytes / pow(1000, $unitIndex), $precision) . ' ' . $unitName;
    }
}

/**
 * Get number to human readable format
 * @param int $number
 * @return string
 */
if (!function_exists('numbers_to_human')) {
    function numbers_to_human(int $number): string
    {
        $units = ['', 'K', 'M', 'B', 'T', 'P', 'E', 'Z', 'Y'];
        for ($i = 0; $number >= 1000; $i++) {
            $number /= 1000;
        }
        return round($number, 1) . $units[$i];
    }
}
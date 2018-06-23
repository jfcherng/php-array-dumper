<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper;

use StringTemplate\SprintfEngine;

class Utility
{
    /**
     * Replace placeholder in strings with nested (array) values.
     *
     * @see https://github.com/nicmart/StringTemplate
     *
     * @param string       $template the template string
     * @param array|string $value    the value the template will be rendered with
     * @param string       $left     the left delimiter
     * @param string       $right    the right delimiter
     *
     * @return string The templated string
     */
    public static function strFormat(string $template, $value, string $left = '{', string $right = '}'): string
    {
        // engine instances
        static $engines = [];

        // well, assuming there is no '\u{e000}' in delimiters
        $engineId = "{$left}\u{e000}{$right}";

        if (!isset($engines[$engineId])) {
            $engines[$engineId] = new SprintfEngine($left, $right);
        }

        return $engines[$engineId]->render($template, $value);
    }

    /**
     * Set the bit.
     *
     * @param int  $flags     the flags
     * @param int  $mask      the mask
     * @param bool $condition the condition
     *
     * @return int
     */
    public static function configBit(int $flags, int $mask, bool $condition): int
    {
        return $condition
            ? static::setBit($flags, $mask)
            : static::clearBit($flags, $mask);
    }

    /**
     * Set the bit.
     *
     * @param int $flags the flags
     * @param int $mask  the mask
     *
     * @return int
     */
    public static function setBit(int $flags, int $mask): int
    {
        return $flags | $mask;
    }

    /**
     * Clear the bit.
     *
     * @param int $flags the flags
     * @param int $mask  the mask
     *
     * @return int
     */
    public static function clearBit(int $flags, int $mask): int
    {
        return $flags & ~$mask;
    }

    /**
     * Toggle the bit.
     *
     * @param int $flags the flags
     * @param int $mask  the mask
     *
     * @return int
     */
    public static function toggleBit(int $flags, int $mask): int
    {
        return $flags ^ $mask;
    }
}

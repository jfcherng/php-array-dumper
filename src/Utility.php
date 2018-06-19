<?php

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
    public static function str_format(string $template, $value, string $left = '{', string $right = '}'): string
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
}

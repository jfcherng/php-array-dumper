<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Dumper;

use Jfcherng\ArrayDumper\Core\AbstractDumper;
use Jfcherng\ArrayDumper\Utility;

class JsonDumper extends AbstractDumper
{
    /**
     * {@inheritdoc}
     */
    const EXTENSION = 'json';

    /**
     * Default indent spaces in PHP json_encode().
     *
     * @var int
     */
    const PHP_JSON_INDENT = 4;

    /**
     * {@inheritdoc}
     *
     * @see http://php.net/manual/en/function.json-encode.php
     */
    protected static $optionsDef = [
        // json_encode() options
        'flags' => JSON_UNESCAPED_UNICODE,
        // the maximum depth
        'depth' => 512,
        // minify the output
        'minify' => false,
        // numbers of spaces used as indentation
        'indent' => 4,
    ];

    /**
     * {@inheritdoc}
     */
    public function pureDump(array $array): string
    {
        $export = json_encode(
            $array,
            Utility::configBit(
                $this->options['flags'],
                JSON_PRETTY_PRINT,
                !$this->options['minify']
            ),
            $this->options['depth']
        );

        if ($this->options['indent'] !== static::PHP_JSON_INDENT) {
            $export = preg_replace_callback(
                '/^( ++)/umS',
                function (array $matches): string {
                    return str_repeat(
                        ' ',
                        $this->options['indent'] * strlen($matches[1]) / static::PHP_JSON_INDENT
                    );
                },
                $export
            );
        }

        return $export;
    }
}

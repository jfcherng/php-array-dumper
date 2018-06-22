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
    ];

    /**
     * {@inheritdoc}
     */
    public function pureDump(array $array): string
    {
        return json_encode(
            $array,
            Utility::configBit(
                $this->options['flags'],
                JSON_PRETTY_PRINT,
                !$this->options['minify']
            ),
            $this->options['depth']
        );
    }
}

<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Dumper;

use Jfcherng\ArrayDumper\Core\AbstractDumper;
use Symfony\Component\Yaml\Yaml;

final class YamlDumper extends AbstractDumper
{
    /**
     * {@inheritdoc}
     */
    const EXTENSION = 'yaml';

    /**
     * {@inheritdoc}
     */
    protected static $optionsDef = [
        // a bit field of DUMP_* constants to customize the dumped YAML string
        'flags' => 0,
        // numbers of spaces used as indentation
        'indent' => 4,
        // the level where you switch to inline YAML
        'inline' => 2,
    ];

    /**
     * {@inheritdoc}
     */
    public function pureDump(array $array): string
    {
        return Yaml::dump(
            $array,
            $this->options['inline'],
            $this->options['indent'],
            $this->options['flags']
        );
    }
}

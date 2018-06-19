<?php

namespace Jfcherng\ArrayDumper\Dumper;

use Symfony\Component\Yaml\Yaml;

class YamlDumper extends AbstractDumper
{
    /**
     * {@inheritdoc}
     */
    const EXTENSION = 'yaml';

    /**
     * {@inheritdoc}
     */
    protected static $optionsDef = [
        // the level where you switch to inline YAML
        'inline' => 2,
        // numbers of spaces used as indentation
        'indent' => 4,
        // a bit field of DUMP_* constants to customize the dumped YAML string
        'flags' => 0,
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

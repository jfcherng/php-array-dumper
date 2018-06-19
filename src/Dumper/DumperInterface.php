<?php

namespace Jfcherng\ArrayDumper\Dumper;

interface DumperInterface
{
    /**
     * Dump an array into its correpsonding form without rendering with a template.
     *
     * @param array $array the array
     *
     * @return string
     */
    public function pureDump(array $array): string;
}

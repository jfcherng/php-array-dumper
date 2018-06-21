<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Core;

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

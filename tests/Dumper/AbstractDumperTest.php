<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Test\Dumper;

use Jfcherng\ArrayDumper\DumperFactory;
use PHPUnit\Framework\TestCase;

abstract class AbstractDumperTest extends TestCase
{
    /**
     * The short name of the dumper such as 'json', 'php', 'yaml', etc...
     *
     * @var string
     */
    protected static $dumperName = 'unknown';

    /**
     * The dumper object.
     *
     * @var object
     */
    protected static $dumper;

    /**
     * The dumper options.
     *
     * @var array
     */
    protected static $dumperOptions = [];

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass(): void
    {
        static::$dumper = DumperFactory::make(
            static::$dumperName,
            static::$dumperOptions,
        );
    }
}

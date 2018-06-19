<?php

namespace Jfcherng\ArrayDumper;

final class DumperFactory
{
    /**
     * Dumper singletons.
     *
     * @var array
     */
    private static $singletons = [];

    /**
     * The constructor.
     */
    private function __construct()
    {
    }

    /**
     * Get a dumper object.
     *
     * @param string $dumper the dumper
     *
     * @return object a new dumper object
     */
    public static function make(string $dumper): object
    {
        $class = static::getClassName($dumper);

        return new $class();
    }

    /**
     * Get the dumper instance.
     *
     * @param string $dumper the dumper
     *
     * @return object the instance
     */
    public static function getInstance(string $dumper): object
    {
        $class = static::getClassName($dumper);

        if (!isset(static::$singletons[$class])) {
            static::$singletons[$class] = new $class();
        }

        return static::$singletons[$class];
    }

    /**
     * Get the class name for the dumper.
     *
     * @param string $dumper the dumper
     *
     * @return string the class name
     */
    private static function getClassName(string $dumper): string
    {
        return __NAMESPACE__ . '\\Dumper\\' . ucfirst($dumper) . 'Dumper';
    }
}

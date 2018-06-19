<?php

namespace Jfcherng\ArrayDumper\Dumper;

use Jfcherng\ArrayDumper\Utility;

abstract class AbstractDumper implements DumperInterface
{
    /**
     * The file extension.
     *
     * @var string
     */
    const EXTENSION = 'unknown';

    /**
     * The dumper options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The default formmat options.
     *
     * @var array
     */
    protected static $optionsDef = [];

    /**
     * The template for rendering.
     *
     * @var string
     */
    protected $template = '{code}';

    /**
     * The constructor.
     *
     * @param array $options the options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Get the default options.
     *
     * @return array the default options
     */
    public function getDefaultOptions(): array
    {
        return static::$optionsDef;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setOptions(array $options): self
    {
        $this->options = $options + static::$optionsDef;

        return $this;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Render template with the code.
     *
     * @param string $code the code
     *
     * @return string
     */
    public function dump(array $array): string
    {
        return Utility::str_format($this->template, [
            'code' => $this->pureDump($array),
        ]);
    }

    /**
     * Dump and output to an external file.
     *
     * @param array  $array    the array
     * @param string $filename the filename
     * @param int    $flags    the flags for file_put_contents()
     *
     * @return bool success or not
     */
    public function toFile(array $array, string $filename, int $flags = 0): bool
    {
        $dir = dirname($filename);

        !is_dir($dir) && mkdir($dir, 0777, true);

        return file_put_contents($filename, $this->dump($array), $flags);
    }
}

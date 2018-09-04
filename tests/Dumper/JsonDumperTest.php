<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Test\Dumper;

/**
 * @coversNothing
 */
class JsonDumperTest extends AbstractDumperTest
{
    /**
     * {@inheritdoc}
     */
    protected static $dumperName = 'json';

    /**
     * {@inheritdoc}
     */
    protected static $dumperOptions = [
        'flags' => \JSON_UNESCAPED_UNICODE,
        'indent' => 4,
        'minify' => false,
    ];

    /**
     * The dumper object.
     *
     * @var object
     */
    protected static $dumper;

    /**
     * Provides testcases.
     *
     * @return array the testcases
     */
    public function dumperDumpDataProvider(): array
    {
        return [
            [
                [
                    0 => 'zero',
                    'foo' => 'bar',
                ],
                <<<'EOT'
{
    "0": "zero",
    "foo": "bar"
}
EOT
            ],
            [
                ['zero', 'one', '二'],
                <<<'EOT'
[
    "zero",
    "one",
    "二"
]
EOT
            ],
        ];
    }

    /**
     * Test JsonDumper::dump().
     *
     * @covers \Jfcherng\ArrayDumper\Dumper\JsonDumper::dump
     * @dataProvider dumperDumpDataProvider
     *
     * @param array  $input  the input
     * @param string $output the expected output
     */
    public function testDump(array $input, string $output): void
    {
        $this->assertSame($output, static::$dumper->dump($input));
    }
}

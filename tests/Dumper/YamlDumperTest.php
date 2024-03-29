<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Test\Dumper;

/**
 * @coversNothing
 *
 * @internal
 */
final class YamlDumperTest extends AbstractDumperTest
{
    /**
     * {@inheritdoc}
     */
    protected static $dumperName = 'yaml';

    /**
     * {@inheritdoc}
     */
    protected static $dumperOptions = [
        'indent' => 2,
        'inline' => 2,
    ];

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
                    '*' => 'bar',
                    'deep' => [
                        'list' => ['zero', 'one', '二'],
                        'map' => ['zero' => 0, 'one' => 1, '二' => 2],
                    ],
                ],
                <<<'EOT'
                0: zero
                '*': bar
                deep:
                  list: [zero, one, 二]
                  map: { zero: 0, one: 1, 二: 2 }
                EOT,
            ],
        ];
    }

    /**
     * Test YamlDumper::dump().
     *
     * @covers \Jfcherng\ArrayDumper\Dumper\YamlDumper::dump
     * @dataProvider dumperDumpDataProvider
     *
     * @param array  $input  the input
     * @param string $output the expected output
     */
    public function testDump(array $input, string $output): void
    {
        static::assertSame($output, rtrim(static::$dumper->dump($input)));
    }
}

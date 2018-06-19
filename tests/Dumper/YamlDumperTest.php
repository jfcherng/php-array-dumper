<?php

namespace Jfcherng\ArrayDumper\Test\Dumper;

use Jfcherng\ArrayDumper\DumperFactory;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class YamlDumperTest extends TestCase
{
    protected static $dumperName = 'yaml';

    /**
     * The dumper object.
     *
     * @var object
     */
    protected static $dumper;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        static::$dumper = DumperFactory::make(static::$dumperName)->setOptions([
            'inline' => 2,
            'indent' => 2,
        ]);
    }

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
EOT
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
        $this->assertSame($output, rtrim(static::$dumper->dump($input)));
    }
}

<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Test\Dumper;

/**
 * @coversNothing
 */
class PhpDumperTest extends AbstractDumperTest
{
    /**
     * {@inheritdoc}
     */
    protected static $dumperName = 'php';

    /**
     * {@inheritdoc}
     */
    protected static $dumperOptions = [
        'indent' => 4,
        'minify' => false,
        'shortArray' => true,
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
                    'foo' => 'bar',
                ],
                <<<'EOT'
<?php

return [
    0 => 'zero',
    'foo' => 'bar',
];
EOT
            ],
            [
                ['zero', 'one', '二'],
                <<<'EOT'
<?php

return [
    0 => 'zero',
    1 => 'one',
    2 => '二',
];
EOT
            ],
        ];
    }

    /**
     * Test PhpDumper::dump().
     *
     * @covers \Jfcherng\ArrayDumper\Dumper\PhpDumper::dump
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

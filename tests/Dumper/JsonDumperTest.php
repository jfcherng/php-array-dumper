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
        'flags' => JSON_UNESCAPED_UNICODE,
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
                '{"0":"zero","foo":"bar"}',
            ],
            [
                ['zero', 'one', '二'],
                '["zero","one","二"]',
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
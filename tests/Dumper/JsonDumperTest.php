<?php

namespace Jfcherng\ArrayDumper\Test\Dumper;

use Jfcherng\ArrayDumper\DumperFactory;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class JsonDumperTest extends TestCase
{
    protected static $dumperName = 'json';

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
            'flags' => JSON_UNESCAPED_UNICODE,
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

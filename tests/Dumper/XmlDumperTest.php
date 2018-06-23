<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Test\Dumper;

/**
 * @coversNothing
 */
class XmlDumperTest extends AbstractDumperTest
{
    /**
     * {@inheritdoc}
     */
    protected static $dumperName = 'xml';

    /**
     * {@inheritdoc}
     */
    protected static $dumperOptions = [
        'encoding' => 'UTF-8',
        'keySpaceToUnderscore' => true,
        'minify' => false,
        'root' => 'root',
        'rootAttr' => [],
        'version' => '1.0',
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
                    'Good guy' => [
                        '_attributes' => ['attr1' => 'value'],
                        'name' => 'Luke Skywalker',
                        'weapon' => 'Lightsaber',
                    ],
                    'Bad guy' => [
                        'name' => 'Sauron',
                        'weapon' => 'Evil Eye ',
                    ],
                ],
                <<<'EOT'
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <Good_guy attr1="value">
    <name>Luke Skywalker</name>
    <weapon>Lightsaber</weapon>
  </Good_guy>
  <Bad_guy>
    <name>Sauron</name>
    <weapon>Evil Eye </weapon>
  </Bad_guy>
</root>
EOT
            ],
        ];
    }

    /**
     * Test XmlDumper::dump().
     *
     * @covers \Jfcherng\ArrayDumper\Dumper\XmlDumper::dump
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

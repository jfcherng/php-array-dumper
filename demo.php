<?php

include __DIR__ . '/vendor/autoload.php';

use Jfcherng\ArrayDumper\DumperFactory;

$array = [
    0 => 'zero',
    '*' => 'bar',
    'deep' => [
        'list' => ['zero', 'one', '二'],
        'map' => ['zero' => 0, 'one' => 1, '二' => 2],
    ],
];

$dumperName = 'yaml';

// initiate a dumper and optionally set its options
$dumper = DumperFactory::make($dumperName, [
    'indent' => 2,
]);

// dump into a string
$string = $dumper->dump($array);

/*
string(83) "0: zero
'*': bar
deep:
  list: [zero, one, 二]
  map: { zero: 0, one: 1, 二: 2 }
"
*/
\var_dump($string);

// dump as an external file
$outputFile = __DIR__ . '/results/test.' . $dumper::EXTENSION;
$success = $dumper->toFile($array, $outputFile);

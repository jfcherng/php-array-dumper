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

// initiate a dumper and set its options
$dumper = DumperFactory::make($dumperName)->setOptions([
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
var_dump($string);

// dump into an external file
$success = $dumper->toFile($array, __DIR__ . '/results/test.' . $dumper::EXTENSION);

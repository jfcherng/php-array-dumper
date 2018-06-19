# php-array-dumper [![Build Status](https://travis-ci.org/jfcherng/php-array-dumper.svg?branch=master)](https://travis-ci.org/jfcherng/php-array-dumper)

Dump an array into PHP code, JSON, YAML, etc...


# Installation

`$ composer require jfcherng/php-array-dumper`


# Example

See `demo.php`.

```php
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
$success = $dumper->toFile($array, __DIR__ . "/results/test." . $dumper::EXTENSION);

```


Supporters <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ATXYY9Y78EQ3Y" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" /></a>
==========

Thank you guys for sending me some cups of coffee.

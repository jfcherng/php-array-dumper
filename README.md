# php-array-dumper

<a href="https://travis-ci.org/jfcherng/php-array-dumper"><img alt="Travis (.org) branch" src="https://img.shields.io/travis/jfcherng/php-array-dumper/master"></a>
<a href="https://packagist.org/packages/jfcherng/php-array-dumper"><img alt="Packagist" src="https://img.shields.io/packagist/dt/jfcherng/php-array-dumper"></a>
<a href="https://packagist.org/packages/jfcherng/php-array-dumper"><img alt="Packagist Version" src="https://img.shields.io/packagist/v/jfcherng/php-array-dumper"></a>
<a href="https://github.com/jfcherng/php-array-dumper/blob/master/LICENSE"><img alt="Project license" src="https://img.shields.io/github/license/jfcherng/php-array-dumper"></a>
<a href="https://github.com/jfcherng/php-array-dumper/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/jfcherng/php-array-dumper?logo=github"></a>
<a href="https://www.paypal.me/jfcherng/5usd" title="Donate to this project using Paypal"><img src="https://img.shields.io/badge/paypal-donate-blue.svg?logo=paypal" /></a>

Dump an array into XML, JSON, YAML, etc...


## Installation

```bash
$ composer require jfcherng/php-array-dumper
```


## Example

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

// 'json', 'xml', 'yaml', 'php'
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
var_dump($string);

// dump as an external file
$outputFile = __DIR__ . '/results/test.' . $dumper::EXTENSION;
$success = $dumper->toFile($array, $outputFile);
```

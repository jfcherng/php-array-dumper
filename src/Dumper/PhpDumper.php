<?php

declare(strict_types=1);

namespace Jfcherng\ArrayDumper\Dumper;

use Jfcherng\ArrayDumper\Core\AbstractDumper;

class PhpDumper extends AbstractDumper
{
    /**
     * {@inheritdoc}
     */
    const EXTENSION = 'php';

    /**
     * {@inheritdoc}
     */
    protected static $optionsDef = [
        // use the short array syntax
        'shortArray' => true,
        // numbers of spaces used as indentation
        'indent' => 4,
    ];

    /**
     * {@inheritdoc}
     */
    protected $template = <<<'EOF'
<?php

return {code};

EOF;

    /**
     * {@inheritdoc}
     */
    public function pureDump(array $array): string
    {
        $object = json_decode(str_replace(['(', ')'], ['&#40', '&#41'], json_encode($array)), true);
        $indent = str_repeat(' ', $this->options['indent']);

        $arraySyntax = $this->options['shortArray']
            ? ["\u{e000}" => '[', "\u{e001}" => ']']
            : ["\u{e000}" => 'array(', "\u{e001}" => ')'];

        $export = strtr(var_export($object, true), [
            'array (' => "\u{e000}",
            ')' => "\u{e001}",
            '&#40' => '(',
            '&#41' => ')',
        ]);
        $export = preg_replace("/ => \n[^\S\n]*(?=\u{e000})/m", ' => ', $export);
        $export = preg_replace("/ => (?=\u{e000}\n[^\S\n]*\u{e001})/m", ' => ', $export);
        $export = preg_replace('/([ ]{2})(?![^ ])/m', $indent, $export);
        $export = preg_replace('/^([ ]{2})/m', $indent, $export);
        $export = strtr($export, $arraySyntax);

        return $export;
    }
}

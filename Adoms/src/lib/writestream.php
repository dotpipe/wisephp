<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className)
{
    $path1 = '/Adoms/src/lib/';
    $path2 = '';

    if (file_exists($path1.$className.'.php'))
        include $path1.$className.'.php';
    else
        include $path2.$className.'.php';
});

class writeStream extends Streams {

    public $stream;
    public $parentType;

    public function __construct() {
        $this->rootType = 'Streams';
        $this->parentType = 'Streams';
        $this->typeOf = 'writeStream';
        $this->dat = new Map();
        $this->datCntr = 0;
    }

    public function addStrm(string $r, bool $bool = FALSE): bool {
        $ed = fopen($r, 'w');
        $this->add($r,$ed);
        $this->sync();
        return 1;

    }
}

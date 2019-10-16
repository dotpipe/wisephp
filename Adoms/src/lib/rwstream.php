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

class rwStream extends Streams {

    public $stream;
    public $parentType;

    public function __construct() {
        $this->rootType = 'Streams';
        $this->parentType = 'Streams';
        $this->typeOf = 'rwStream';
        $this->dat = new Map();
        $this->buffSize = 16;
        $this->datCntr = 0;
        $this->delim = ';';
    }

    public function add(string $r, bool $bool = TRUE) {
        $ed = fopen($r, 'w+');
        $this->add($r,$ed);
        $this->sync();
        return 1;

    }
}

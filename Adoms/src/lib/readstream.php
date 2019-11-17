<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className) {
    foreach ([
        'Adoms/src/lib/',
        ''
    ] as $Path) {
        if (!file_exists($Path . $className . '.php')) {
            continue;
        }
        include $Path . $className . '.php';
    }
});

class readStream extends Streams {

    public $stream;
    public $strmkey;
    public $parentType;
    public $delim;

    public function __construct() {
        $this->rootType = 'Streams';
        $this->parentType = 'Streams';
        $this->typeOf = 'readStream';
        $this->dat = new Map();
        $this->buffSize = 16;
        $this->datCntr = 0;
        $this->delim = ';';
    }

    public function addStream(string $r, bool $bool = FALSE) {
        $ed = fopen($r, 'r');
        $this->add($r,$ed);
        $this->sync();
        return 1;

    }
}

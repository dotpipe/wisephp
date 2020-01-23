<?php declare (strict_types = 1);
namespace Adoms\src\lib;
//


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
        if (!\file_exists($r))
            return 0;
        $ed = fopen($r, 'w');
        $this->add($r,$ed);
        $this->sync();
        return 1;

    }
}

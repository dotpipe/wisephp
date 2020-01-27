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
        if (!\file_exists($this->dir . $r))
            return false;
        $ed = fopen($this->dir . $r, 'w');
        $this->add($this->dir . $r,$ed);
        $this->sync();
        return true;

    }
}

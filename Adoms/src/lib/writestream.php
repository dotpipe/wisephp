<?php
namespace Adoms\src\lib;

include_once("streams.php");

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

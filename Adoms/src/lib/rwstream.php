<?php
namespace Adoms\src\lib;

include_once("streams.php");

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

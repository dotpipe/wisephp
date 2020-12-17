<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class writeStream extends Streams {

    public $stream;
    public $parentType;

    public function __construct() {
        $this->rootType = 'Streams';
        $this->parentType = 'Streams';
        $this->typeOf = 'writeStream';
        $this->datCntr = 0;
        $this->dir = "./";
    }
/*
    public function addStrm(string $r, bool $bool = FALSE): bool {
        if (!\file_exists($this->dir . $r))
            return false;
        $ed = fopen($this->dir . $r, 'w');
        $this->add($this->dir . $r,$ed);
        $this->sync();
        return true;

    }
*/
}
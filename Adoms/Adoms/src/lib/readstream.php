<?php
namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


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
        if (!\file_exists($this->dir . $r))
            return false;
        $ed = fopen($this->dir . $r, 'r');
        $this->add($this->dir . $r,$ed);
        $this->sync();
        return true;

    }
}

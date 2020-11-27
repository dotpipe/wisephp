<?php declare(strict_types = 1);
namespace Adoms\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

class readStream extends Streams
{
    public $stream;
    public $strmkey;
    public $parentType;
    public $delim;

    public function __construct()
    {
        $this->rootType = 'Streams';
        $this->parentType = 'Streams';
        $this->typeOf = 'readStream';
        $this->buffSize = 0;
        $this->datCntr = 0;
        $this->delim = ';';
        $this->dir = "./";
    }

    public function addStream(string $r, bool $bool = false)
    {
        if (!\file_exists($this->dir . $r)) {
            return false;
        }
        $ed = fopen($this->dir . $r, 'r');
        $this->add($this->dir . $r, $ed);
        $this->sync();
        return true;
    }
}

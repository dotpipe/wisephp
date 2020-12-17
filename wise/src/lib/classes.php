<?php declare (strict_types = 1);
namespace wise\src\lib;



interface Classes
{

    public function size();
    public function save(string $json_name);
    public function setIndex(int $indx);
    public function getIndex();
    public function loadJSON(string $json_name);
    public function Iter();
    public function revIter();
    public function Cycle();
    public function revCycle();
    public function current();

}

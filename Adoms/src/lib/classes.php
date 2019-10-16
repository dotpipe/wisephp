<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className)
{
    $path1 = 'Adoms/src/lib/';
    $path2 = '';
    if ($className == "Classes")
        return;
    if (file_exists($path1.$className.'.php'))
        include $path1.$className.'.php';
    else
        include $path2.$className.'.php';
});

interface Classes {

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
    public function next();
    public function prev();

}

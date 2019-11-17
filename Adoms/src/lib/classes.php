<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className) {
    if ($className === "Classes") {
        return;
    }
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
    public function next();
    public function prev();

}

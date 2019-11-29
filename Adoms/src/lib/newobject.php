<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
    include("c:\\xampp\\htdocs\\adoms\\" . strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


class newObject {
    public function newObj($r, $e = "Any") {
        switch ($r) {
            case 'Vector':
                return new Vector($e);
            case 'Map':
                return new Map();
            case 'mMap':
                return new mMap();
            case 'Queue':
                return new Queue();
            case 'Dequeue':
                return new Queue();
            case 'Set':
                return new Set();
            case 'mSet':
                return new mSet();
            case 'Matrix':
                return new Matrix($e);
            case 'rwStream':
                return new rwStream();
            case 'writeStream':
                return new writeStream($e);
            case 'readStream':
                return new readStream($e);
            case 'CSS':
                return new css();
            case 'API':
                return new api();
            default:
                return null;
        }
    }
}

<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className)
{
    $path1 = '/Adoms/src/lib/';
    $path2 = '';

    if ($className == "newObject")
        return;
    if (file_exists($path1.$className.'.php'))
        include $path1.$className.'.php';
    else
        include $path2.$className.'.php';
});

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

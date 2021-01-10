<?php
namespace src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

class newObject
{
    /**
     * @method __construct
     * @param none
     * @return void
     * 
     * initialize a new dynamic object in code
     */
    public function __construct(string $r, string $e = "Any")
    {
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
                return new api($e);
            default:
                return null;
        }
    }

    /**
     * @method newObj
     * @param type
     * @param subtype
     * 
     * Create and return new container object
     * 
     */
    public function newObj(string $t, string $e = "Any")
    {
        return new newObject($t, $e);
    }
}

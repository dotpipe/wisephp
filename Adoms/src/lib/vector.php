<?php declare(strict_types = 1);
namespace Adoms\src\lib;

use Adoms\src\lib\Map;

require_once __DIR__ . '../../../../vendor/autoload.php';
class Vector extends Common
{
    public $vectorTemp;
    public $parentType;
    public $childType;
    // $vect[$datCntr] (The index pointed to)
    public $datCntr;

    public function __construct($type)
    {
        if ($type == 'Dequeue') {
            $this->childType = 'Dequeue';
            $this->parentType = 'Vector';
        } elseif ($type == 'Queue') {
            $this->childType = 'Queue';
            $this->parentType = 'Vector';
        } elseif ($type == 'Set') {
            $this->childType = 'Set';
            $this->parentType = 'Vector';
        } elseif ($type == 'SortedSet') {
            $this->childType = 'SortedSet';
            $this->parentType = 'Vector';
        } elseif ($type == 'NavigableSet') {
            $this->childType = 'NavigableSet';
            $this->parentType = 'Vector';
        } elseif ($type == 'Map') {
            $this->childType = 'Map';
            $this->parentType = 'Vector';
        } elseif ($type == 'SortedMap') {
            $this->childType = 'SortedMap';
            $this->parentType = 'Vector';
        } elseif ($type == 'NavigableMap') {
            $this->childType = 'NavigableMap';
            $this->parentType = 'Vector';
        } elseif ($type == 'mMap') {
            $this->childType = 'mMap';
            $this->parentType = 'Vector';
        } elseif ($type == 'Stack') {
            $this->childType = 'Stack';
            $this->parentType = 'Vector';
        } elseif ($type == 'Thread') {
            $this->childType = 'Thread';
            $this->parentType = 'Vector';
        } elseif ($type == 'String') {
            $this->childType = 'String';
            $this->parentType = 'Vector';
        } elseif ($type == 'Any') {
            $this->childType = 'Any';
            $this->parentType = 'Vector';
        } elseif ($type == 'Array') {
            $this->childType = 'Array';
            $this->parentType = 'Vector';
        } else {
            $this->childType = 'Any';
            $this->parentType = 'Vector';
        }
        $this->rootType = 'Container';
        $this->typeOf = 'Vector';
        $this->dat = array();
        $this->pv = 0;
        return true;
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy()
    {
        $vectorTemp = null;
        $parentType = null;
        $childType = null;
        $this->dat = null;
    }

    public function conv2vector($m): Vector
    {
        if (is_object($m) && $m->parentType == "Set") {
            $vect = new Vector("String");
        } elseif (is_object($m) && $m->parentType == "mSet") {
            $vect = new Vector("Set");
        } elseif (is_object($m) && $m->parentType == "mMap") {
            $vect = new Vector("Map");
        } elseif (is_object($m) && $m->parentType == "Matrix") {
            $vect = new Vector("Any");
        } else {
            $vect = new Vector("String");
            $m = json_decode($m);
        }

        foreach ($m as $n => $s) {
            $vect->push($s);
        }

        return $vect;
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear()
    {
        $this->dat = array();
    }

    /**
     * public function push
     * @parameters mixed
     *
     */
    // Add Vector with $r
    public function push($r): bool
    {
        if ($r == null) {
            return false;
        } elseif ($this->childType == 'String' && !is_object($r) && !is_array($r)) {
            array_push($this->dat, $r);
        } elseif ($this->childType == 'Any' || ($this->childType == 'Array' && is_array($r)) || $this->childType == $r->childType) {
            array_push($this->dat, $r);
        } elseif (!is_object($r) && !is_array($r)) {
            return false;
        } else {
            throw new Type_Error('Invalid Type');
            return false;
        }
        return true;
    }

    /**
     * public function pop
     * @parameters none
     *
     */
    // Remove $r from Vector
    public function pop(): void
    {
        if ($this->size() == 1) {
            $this->dat = null;
        }

        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Vector Array');
            }

            return;
        }
        $this->dat = array_pop($this->dat);
        $this->pt = current($this->dat);
        return;
    }

    /**
     * public function add
     * @parameters mixed, int
     *
     */
    public function add($r, int $indx = 0)
    {
        $setTemp = '';
        if ($this->size() == 0) {
            array_push($this->dat, $r);
            return true;
        } elseif ($indx < 0 || $indx >= $this->size()) {
            throw new IndexException('Invalid Index');
            return false;
        }

        if ($this->childType == "Any" || $r->childType == $this->childType) {
            switch ($this->childType) {
                case 'Any':{
                        $obj = new $this->childType . "('Any')";
                        array_push($this->dat, new $obj());
                        return;
                    }
                default:{
                        $obj = new $this->childType . "('String')";
                        array_push($this->dat, new $obj());
                        return;
                    }
            }
            switch ($this->childType) {
                case 'mMap':{
                        $obj = new mMap('Any');
                        $obj->newMap("first", $r);
                        array_push($this->dat, new $obj());
                        return;
                    }
                case 'String':{
                        $obj = new $this->childType . "('String')";
                        array_push($this->dat, new $obj());
                        return;
                    }
                case 'Array':{
                        $obj = new $this->childType . "('Any')";
                        array_push($this->dat, new $obj());
                        return;
                    }
                default:{
                        $this->add($r);
                    }
            }
            $this->pt = current($this->dat);
            $this->sync();
        } else {
            return false;
        }

        $this->pt = current($this->dat);
        return true;
    }

    /**
     * public function at
     * @parameters int
     *
     */
    // Return Vector at $indx
    public function at(int $indx)
    {
        if ($this->size() == 0) {
            return false;
        }
        $temp = array();
        if ($indx < $this->size() && $indx >= 0) {
            return $this->dat[$indx];
            $temp;
        }
        return false;
    }

    /**
     * public function loadJSON
     * @parameters none
     *
     */
    // Insert new Vector<T> (Element<T>)
    public function insVect($ins)
    {
        if ($this->childType == 'Dequeue') {
            $r = new Dequeue();
        } elseif ($this->childType == 'Queue') {
            $r = new Queue();
        } elseif ($this->childType == 'Set') {
            $r = new Set();
        } elseif ($this->childType == 'SortedSet') {
            $r = new SortedSet();
        } elseif ($this->childType == 'NavigableSet') {
            $r = new NavigableSet();
        } elseif ($this->childType == 'Map') {
            $r = new Map();
        } elseif ($this->childType == 'SortedMap') {
            $r = new SortedMap();
        } elseif ($this->childType == 'NavigableMap') {
            $r = new NavigableMap();
        } elseif ($this->childType == 'mMap') {
            $r = new mMap();
        } elseif ($this->childType == 'Stack') {
            $r = new Stack();
        } elseif ($this->childType == 'Thread') {
            $r = new Thread();
        } elseif ($this->childType == 'String') {
            $r = new Vector("String");
        } elseif ($this->childType == 'Any') {
            $r = new Vector("Any");
        } elseif ($this->childType == 'Array') {
            $r = new Vector("Array");
        } else {
            throw new Type_Error('Invalid Type');
            return false;
        }

        array_splice($this->dat, $ins, 0, $r);
        return true;
    }

    /**
     * public function remVect
     * @parameters int
     *
     */
    // Remove $r from Vector
    public function remVect(int $r)
    {
        if ($this->size() == 0 || $this->size() <= $r || $r < 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Vector Array');
            }

            return false;
        }
        
        return array_splice($this->dat, $r, 1);
    }
    /*
    /**
     * public function sync
     * @parameters none
     *
     *
    public function sync(): bool {
    if (is_object($this->pt) && $this->childType == "Set" && $this->pt->dat != null) {
    $t = $this->pt;
    $t->dat = array_unique($t->dat);
    $this->pt->dat = $t->dat;
    }
    if ($this->pv < $this->size()) {
    if ($this->pt != null)
    $this->dat[$this->pv] = $this->pt;
    }
    if ($this->datCntr >= $this->size()) {
    $this->datCntr = $this->size() - 1;
    end($this->dat);
    }
    $this->pt = current($this->dat);
    $this->pv = $this->datCntr;
    return true;
    }
     */
}

<?php declare (strict_types = 1);
namespace wise\src\lib;
use wise\src\lib\Map;
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
        } else if ($type == 'Queue') {
            $this->childType = 'Queue';
            $this->parentType = 'Vector';
        } else if ($type == 'Set') {
            $this->childType = 'Set';
            $this->parentType = 'Vector';
        } else if ($type == 'SortedSet') {
            $this->childType = 'SortedSet';
            $this->parentType = 'Vector';
        } else if ($type == 'NavigableSet') {
            $this->childType = 'NavigableSet';
            $this->parentType = 'Vector';
        } else if ($type == 'Map') {
            $this->childType = 'Map';
            $this->parentType = 'Vector';
        } else if ($type == 'SortedMap') {
            $this->childType = 'SortedMap';
            $this->parentType = 'Vector';
        } else if ($type == 'NavigableMap') {
            $this->childType = 'NavigableMap';
            $this->parentType = 'Vector';
        } else if ($type == 'mMap') {
            $this->childType = 'mMap';
            $this->parentType = 'Vector';
        } else if ($type == 'Stack') {
            $this->childType = 'Stack';
            $this->parentType = 'Vector';
        } else if ($type == 'Thread') {
            $this->childType = 'Thread';
            $this->parentType = 'Vector';
        } else if ($type == 'String') {
            $this->childType = 'String';
            $this->parentType = 'Vector';
        } else if ($type == 'Any') {
            $this->childType = 'Any';
            $this->parentType = 'Vector';
        } else if ($type == 'Array') {
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
     * @method destroy
     * @param none
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
        } else if (is_object($m) && $m->parentType == "mSet") {
            $vect = new Vector("Set");
        } else if (is_object($m) && $m->parentType == "mMap") {
            $vect = new Vector("Map");
        } else if (is_object($m) && $m->parentType == "Matrix") {
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
     * @method clear
     * @param none
     *
     */
    public function clear()
    {
        $this->dat = array();
    }

    /**
     * @method push
     * @param mixed
     *
     *
     * Add Vector with $r
     */
    public function push($r): bool
    {
        if ($r == null) {
            return false;
        } else if ($this->childType == 'String' && !is_object($r) && !is_array($r)) {
            array_push($this->dat, $r);
        } else if ($this->childType == 'Any' || ($this->childType == 'Array' && is_array($r)) || $this->childType == $r->childType) {
            array_push($this->dat, $r);
        } else if (!is_object($r) && !is_array($r)) {
            return false;
        } else {
            throw new Type_Error('Invalid Type');
            return false;
        }
        return true;
    }

    /**
     * @method pop
     * @param none
     *
     *
     * Remove $r from Vector
     */
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
     * @method add
     * @param mixed, int
     *
     */
    public function add($r, int $indx = 0)
    {
        $setTemp = '';
        if ($this->size() == 0) {
            array_push($this->dat, $r);
            return true;
        } else if ($indx < 0 || $indx >= $this->size()) {
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
     * @method at
     * @param int
     *
     *
     * Return Vector at $indx
     */
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
     * @method loadJSON
     * @param none
     *
     *
     * Insert new Vector<T> (Element<T>)
     */
    public function insVect($ins)
    {

        if ($this->childType == 'Dequeue') {
            $r = new Dequeue();
        } else if ($this->childType == 'Queue') {
            $r = new Queue();
        } else if ($this->childType == 'Set') {
            $r = new Set();
        } else if ($this->childType == 'SortedSet') {
            $r = new SortedSet();
        } else if ($this->childType == 'NavigableSet') {
            $r = new NavigableSet();
        } else if ($this->childType == 'Map') {
            $r = new Map();
        } else if ($this->childType == 'SortedMap') {
            $r = new SortedMap();
        } else if ($this->childType == 'NavigableMap') {
            $r = new NavigableMap();
        } else if ($this->childType == 'mMap') {
            $r = new mMap();
        } else if ($this->childType == 'Stack') {
            $r = new Stack();
        } else if ($this->childType == 'Thread') {
            $r = new Thread();
        } else if ($this->childType == 'String') {
            $r = new Vector("String");
        } else if ($this->childType == 'Any') {
            $r = new Vector("Any");
        } else if ($this->childType == 'Array') {
            $r = new Vector("Array");
        } else {
            throw new Type_Error('Invalid Type');
            return false;
        }

        array_splice($this->dat,$ins,0,$r);
        return true;
    }

    /**
     * @method remVect
     * @param int
     *
     *
     * Remove $r from Vector
     */
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
}

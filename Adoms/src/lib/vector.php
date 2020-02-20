<?php declare (strict_types = 1);
namespace Adoms\src\lib;


class Vector extends Container implements Classes {

    public $vectorTemp;
    public $parentType;
    public $childType;
    // $vect[$datCntr] (The index pointed to)
    public $datCntr;

    public function __construct($type) {
        if ($type == 'Dequeue') {
            $this->childType = 'Dequeue';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Queue') {
            $this->childType = 'Queue';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Set') {
            $this->childType = 'Set';
            $this->parentType = 'Vector';
        }
        else if ($type == 'SortedSet') {
            $this->childType = 'SortedSet';
            $this->parentType = 'Vector';
        }
        else if ($type == 'NavigableSet') {
            $this->childType = 'NavigableSet';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Map') {
            $this->childType = 'Map';
            $this->parentType = 'Vector';
        }
        else if ($type == 'SortedMap') {
            $this->childType = 'SortedMap';
            $this->parentType = 'Vector';
        }
        else if ($type == 'NavigableMap') {
            $this->childType = 'NavigableMap';
            $this->parentType = 'Vector';
        }
        else if ($type == 'mMap') {
            $this->childType = 'mMap';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Stack') {
            $this->childType = 'Stack';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Thread') {
            $this->childType = 'Thread';
            $this->parentType = 'Vector';
        }
        else if ($type == 'String') {
            $this->childType = 'String';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Any') {
            $this->childType = 'Any';
            $this->parentType = 'Vector';
        }
        else if ($type == 'Array') {
            $this->childType = 'Array';
            $this->parentType = 'Vector';
        }
        else {
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
    public function destroy() {
        $vectorTemp = null;
        $parentType = null;
        $childType = null;
        $this->dat = null;
    }

    public function conv2vector($m): Map
    {
        if (is_object($m) && $m->parentType == "Set")
            $vect = new Vector("String");
        else if (is_object($m) && $m->parentType == "mSet")
            $vect = new Vector("Set");
        else if (is_object($m) && $m->parentType == "mMap")
            $vect = new Vector("Map");
        else if (is_object($m) && $m->parentType == "Matrix")
            $vect = new Vector("Any");
        else {
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
    public function clear() {
        $this->dat = array();
    }

    /**
     * public function push
     * @parameters mixed
     *
     */
    // Add Vector with $r
    public function push($r): bool {
        if ($r == null)
            return false;
        else if ($this->childType == 'String' && !is_object($r) && !is_array($r))
            $this->dat[] = $r;
        else if ($this->childType == 'Any' || ($this->childType == 'Array' && is_array($r)) || $this->childType == $r->childType)
            $this->dat[] = $r;
        else if (!is_object($r) && !is_array($r)) {
            return false;
        }
        else {
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
    public function pop(): void {
        if ($this->size() == 1)
            $this->dat = null;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return;
        }
        $this->dat = array_slice($this->dat, -1);
        $this->pt = current($this->dat);
        return;
    }

    /**
     * public function add
     * @parameters mixed, int
     *
     */
    public function add($r, int $indx = 0) {
        $setTemp = '';
        if ($this->size() == 0) {
            $this->dat[] = $r;
            return true;
        }
        else if ($indx < 0 || $indx >= $this->size()) {
            throw new IndexException('Invalid Index');
            return false;
        }
        if ($this->childType == "Any" || $r->childType == $this->childType
            || ($this->childType == 'Array' && is_array($r))) {
            $t = null;
            if ($this->childType != 'Any') {
                $obj = $this->childType . "('String')";
                $t = new $obj();
            }
            else {
                $obj = $this->childType . "('Any')";
                $t = new $obj();
            }
            if ($this->childType == "mMap")
                $t->newMap($r);
            else if ($this->childType == "String")
                $t->dat[] = $r;
            else if ($this->childType == "Array")
                $t->dat[] = $r;
            else
                $t->add($r);
            $this->pt = current($this->dat);
            $this->sync();
        }
        else return false;
        $this->pt = current($this->dat);
        return true;
    }

    /**
     * public function at
     * @parameters int
     *
     */
    // Return Vector at $indx
    public function at(int $indx) {
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
    public function insVect($ins) {

        if ($this->childType == 'Dequeue') {
            $r = new Dequeue();
        }
        else if ($this->childType == 'Queue') {
            $r = new Queue();
        }
        else if ($this->childType == 'Set') {
            $r = new Set();
        }
        else if ($this->childType == 'SortedSet') {
            $r = new SortedSet();
        }
        else if ($this->childType == 'NavigableSet') {
            $r = new NavigableSet();
        }
        else if ($this->childType == 'Map') {
            $r = new Map();
        }
        else if ($this->childType == 'SortedMap') {
            $r = new SortedMap();
        }
        else if ($this->childType == 'NavigableMap') {
            $r = new NavigableMap();
        }
        else if ($this->childType == 'mMap') {
            $r = new mMap();
        }
        else if ($this->childType == 'Stack') {
            $r = new Stack();
        }
        else if ($this->childType == 'Thread') {
            $r = new Thread();
        }
        else if ($this->childType == 'String') {
            $r = new Vector("String");
        }
        else if ($this->childType == 'Any') {
            $r = new Vector("Any");
        }
        else if ($this->childType == 'Array') {
            $r = new Vector("Array");
        }
        else {
            throw new Type_Error('Invalid Type');
            return false;
        }

        $t = array();
        for ($i = 0 ; $i < $ins ; $i++)
            $t[] = $this->dat[$i];
        $t[] = $r;

        for ($i = $ins ; $i < $this->size() ; $i++)
            $t[] = $this->dat[$i];
        $this->dat = $t;

        $t = array();
        return true;
    }
    
    /**
     * public function remVect
     * @parameters int
     *
     */
    // Remove $r from Vector
    public function remVect(int $r) {
        if ($this->size() == 0 || $this->size() <= $r || $r < 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return false;
        }
        $temporneous = array();

        for ($i = 0; $i < $this->size(); $i++) {
            if ($i != $r)
                $temporneous[] = $this->dat[$i];
        }
        reset($temporneous);
        return $this->dat = $temporneous;
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

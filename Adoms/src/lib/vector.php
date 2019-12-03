<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

class Vector implements Classes {

    public $vectorTemp;
    public $parentType;
    public $childType;
    // Pointer to current Index
    public $vect;
    // $vect[$datCntr] (The index pointed to)
    private $datCntr;

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
            throw new Type_Error('Invalid Type');
            return 0;
        }
        $this->rootType = 'Container';
        $this->typeOf = 'Vector';
        $this->dat = array();
        $this->pv = 0;
        return 1;
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

    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear() {
        $this->dat = array();
    }

    /**
     * public function size
     * @parameters none
     *
     */
    // Report Size of Container
    public function size() {
        return count($this->dat);
    }

    /**
     * public function save
     * @parameters string
     *
     */
    public function save(string $json_name) {
        $fp = fopen("$json_name", "w");
        fwrite($fp, serialize($this));
        fclose($fp);
        return 1;
    }

    /**
     * public function loadJSON
     * @parameters string
     *
     */
    public function loadJSON(string $json_name) {
        if (file_exists("$json_name") && filesize("$json_name") > 0)
            $fp = fopen("$json_name", "r");
        else
            return 0;
        $json_context = fread($fp, filesize("$json_name"));
        $old = unserialize($json_context);
        $b = $old;
        foreach ($b as $key => $val) {
            $this->$key = $b->$key;
        }
        return 1;
    }

    /**
     * public function push
     * @parameters mixed
     *
     */
    // Add Vector with $r
    public function push($r) {
        if ($r == null)
            return;
        else if ($this->childType == 'String' && !is_object($r) && !is_array($r))
            $this->dat[] = $r;
        else if ($this->childType == 'Any' || ($this->childType == 'Array' && is_array($r)) || $this->childType == $r->childType)
            $this->dat[] = $r;
        else if ($this->childType == 'Array' && is_array($r))
            $this->dat[] = $r;
        else if (!is_object($r) && !is_array($r)) {
            return 0;
        }
        else {
            throw new Type_Error('Invalid Type');
            return 0;
        }
        return 1;
    }

    /**
     * public function pop
     * @parameters none
     *
     */
    // Remove $r from Vector
    public function pop() {
        if ($this->size() == 1)
            $this->dat = null;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        return $this->dat = array_slice($this->dat, -1);
    }

    /**
     * public function getIndex
     * @parameters none
     *
     */
    // Get Index
    public function getIndex() {
        return $this->datCntr;
    }

    /**
     * public function setIndex
     * @parameters int
     *
     */
    // Sets and Joins Map Index
    public function setIndex(int $indx) {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector');
            return 0;
        }
        if ($indx < $this->size()) {
            reset($this->dat);
            for($i = 0 ; $i < $indx ; $i++)
                next($this->dat);
            $this->datCntr = $indx;
            $this->sync();
            return 1;
        }
        return 1;
    }

    /**
     * public function current
     * @parameters none
     *
     */
    // Retrieve current Index of Vector Pointer
    public function current() {
        return $this->getIndex();
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
            return 1;
        }
        else if ($indx < 0 || $indx >= $this->size()) {
            throw new IndexException('Invalid Index');
            return 0;
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
            $this->vect = $t;
            $this->sync();
        }
        else return 0;

        return 1;
    }

    /**
     * public function at
     * @parameters int
     *
     */
    // Return Vector at $indx
    public function at(int $indx) {
        if ($this->size() == 0) {
            return 0;
        }
        $temp = array();
        if ($indx < $this->size() && $indx >= 0) {
            return $this->dat[$indx];
            $temp;
        }
        return 0;
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
            return 0;
        }

        $t = array();
        for ($i = 0 ; $i < $ins ; $i++)
            $t[] = $this->dat[$i];
        $t[] = $r;

        for ($i = $ins ; $i < $this->size() ; $i++)
            $t[] = $this->dat[$i];
        $this->dat = $t;

        $t = array();
        return 1;
    }

    /**
     * public function hasNext
     * @parameters none
     *
     */
    // Returns 1 if Vector has next Element
    public function hasNext() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        if ($this->datCntr + 1 < $this->size())
            return 1;
        return 0;
    }

    /**
     * public function nextVect
     * @parameters none
     *
     */
    // Iterate once forward through Vector
    public function next() {
        if ($this->hasNext()) {
            next($this->dat);
            $this->datCntr++;
            $this->sync();
            return 1;
        }
        return 0;
    }

    /**
     * public function Iter
     * @parameters none
     *
     */
    // Iterate Forward through Vector
    public function Iter() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        if ($this->next()) {
            $this->sync();
            return 1;
        }
    }

    /**
     * public function Cycle
     * @parameters none
     *
     */
    // Cycle Forward through Vector
    public function Cycle() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        if ($this->next() == 0) {
            reset($this->dat);
            $this->sync();
            $this->datCntr = 0;
            return 0;
        }
        return 1;
    }

    /**
     * public function revIter
     * @parameters none
     *
     */
    // Iterate Forward through Vector
    public function revIter() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        if ($this->prev()) {
            $this->sync();
            return 1;
        }
        return 0;
    }

    /**
     * public function revCycle
     * @parameters none
     *
     */
    public function revCycle() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        if ($this->prev() == 0) {
            end($this->dat);
            $this->datCntr = $this->size() - 1;
            $this->sync();
            return 0;
        }
        return 1;
    }

    /**
     * public function hasPrev
     * @parameters none
     *
     */
    // Return 1 if Previous Vector exists
    public function hasPrev() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector Array');
            return 0;
        }
        if ($this->getIndex() - 1 >= 0)
            return 1;
        return 0;
    }

    /**
     * public function prevVect
     * @parameters none
     *
     */
    // Iterate to Previous Vector if $bool = 1;
    // Setup $cntDecr (index) for Prev. Vector if $bool = 0;
    public function prev() {
        if ($this->hasPrev()) {
            prev($this->dat);
            $this->sync();
            $this->datCntr--;
            return 1;
        }
        return 0;
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
            return 0;
        }
        $temporneous = array();

        for ($i = 0; $i < $this->size(); $i++) {
            if ($i != $r)
                $temporneous[] = $this->dat[$i];
        }
        reset($temporneous);
        return $this->dat = $temporneous;
    }

    /**
     * public function sync
     * @parameters none
     *
     */
    public function sync() {
        if (is_object($this->vect) && $this->childType == "Set" && $this->vect->dat != null) {
            $t = $this->vect;
            $t->dat = array_unique($t->dat);
            $this->vect->dat = $t->dat;
        }
        if ($this->pv < $this->size()) {
            if ($this->vect != null)
                $this->dat[$this->pv] = $this->vect;
        }
        if ($this->datCntr >= $this->size()) {
            $this->datCntr = $this->size() - 1;
            end($this->dat);
        }
        $this->vect = $this->dat[$this->datCntr];
        $this->pv = $this->datCntr;
        return 1;
    }
}

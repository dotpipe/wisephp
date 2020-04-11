<?php declare (strict_types = 1);
namespace Adoms\src\lib;


class NavigableMap extends SortedMap {

    public $parentType;

    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Map';
        $this->typeOf = 'NavigableMap';
    }

    public function destroy() {
        $this->pt = null;
    }

    /**
     * public function ceilKey
     * @parameters string
     *
     */
    // Return Values <= $r
    public function ceilKey(string $r) {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        $handler = $this->dat;
        $top = array_search(max($this->dat),$this->dat);
        return $top;
    }

    /**
     * public function descMap
     * @parameters none
     *
     */
    // Reverse order of Map
    public function revMap(): bool {
        array_reverse($this->dat,TRUE);
        return true;
    }

    /**
     * public function floorEntry
     * @parameters string
     *
     */
    // Get all Values >= $v
    public function floorEntry(string $v) {
        $vMap = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        $handler = $this->dat;
        $bottom = array_search(min($this->dat),$this->dat);
        return bottom;
    }

    /**
     * public function navigableKeySet
     * @parameters string
     *
     */
    // Return all Keys
    public function navigableKeySet() {
        $mapTempK = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        else if ($this->size() == 1)
            return array($this->dat[0]);
        for ($i = 0; $i < $this->size(); $i++) {
            $mapTempK[] = $this->dat[$i];
        }
        return $mapTempK;
    }

    /**
     * public function pollFirst
     * @parameters none
     *
     */
    // Get first entry in Map and remove
    public function pollFirst() {
        $mapTempK = array();
        $mapTempV = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        else if ($this->size() == 1) {
            $j[0] = $this->dat[0];
            $j[1] = $this->value[1];
            $this->dat = null;
            $this->value = null;
            return $j;
        }
        for ($i = 1; $i < $this->size(); $i++) {
            $mapTempK[] = $this->dat[$i];
            $mapTempV[] = $this->value[$i];
            break;
        }
        if (sizeof($mapTempK) == 0) {
            $this->dat = null;
            $this->value = null;
            $this->setIndex(0);
            return true;
        }
        $j[0] = $this->dat[0];
        $j[1] = $this->value[0];
        $this->dat = $mapTempK;
        $this->value = $mapTempV;
        $this->setIndex($this->getIndex());
        return $j;
    }

    /**
     * public function pollLast
     * @parameters none
     *
     */
    // Get last entry in Map and Remove
    public function pollLast() {
        $mapTempK = array();
        $mapTempV = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        else if ($this->size() == 1) {
            $j[0] = $this->dat[0];
            $j[1] = $this->value[1];
            $this->dat = null;
            $this->value = null;
            return $j;
        }
        for ($i = 0; $i < $this->size(); $i++) {
            $mapTempK[] = $this->dat[$i];
            $mapTempV[] = $this->value[$i];
        }
        if (sizeof($tempAneous) == 0) {
            $this->dat = null;
            $this->value = null;
            $this->setIndex($this->getIndex());
            return true;
        }
        $j[0] = $this->dat[$this->size()-1];
        $j[1] = $this->value[$this->size()-1];
        $this->dat = $mapTempK;
        $this->value = $mapTempV;
        $this->setIndex($this->getIndex());
        return $j;
    }
}

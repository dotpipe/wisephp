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
        $vMap = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        else if ($this->size() == 1)
            return array($this->dat[0], $this->value[0]);
        for ($i = 0; $i < $this->size(); $i++) {
            if ($r <= $this->value[$i]) {
                $vMap[] = $this->dat[$i-1];
                $vMap[] = $this->value[$i-1];
                return $vMap;
            }
        }
        return false;
    }

    /**
     * public function descKeySet
     * @parameters none
     *
     */
    // Descending Map Keys
    public function descKeySet() {
        $vMap = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        else if ($this->size() == 1)
            return array($this->dat[0], $this->value[0]);
        $keys = $this->dat;
        rsort($keys, SORT_STRING);
        for ($i = 0; $i < $this->size(); $i++) {
            for ($j = $i; $j < $this->size(); $j++) {
                if ($keys[$i] == $this->dat[$j]) {
                    $mapTempK[] = $this->dat[$j];
                    $mapTempV[] = $this->value[$j];
                    break;
                }
            }
        }
        $this->dat = $mapTempK;
        $this->value = $mapTempV;
        return true;
    }

    /**
     * public function descMap
     * @parameters none
     *
     */
    // Reverse order of Map
    public function descMap(): bool {
        $mapTempK = array();
        $mapTempV = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        else if ($this->size() == 1)
            return array($this->dat, $this->value);
        for ($j = $this->size()-1; $j >= 0; $j--) {
            $mapTempK[] = $this->dat[$j];
            $mapTempV[] = $this->value[$j];
        }
        $this->dat = $mapTempK;
        $this->value = $mapTempV;
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
        else if ($this->size() == 1)
            return array($this->dat[0], $this->value[0]);
        for ($i = 0; $i < $this->size(); $i++) {
            if (! ($v >= $this->value[$i])) {
                $vMap[] = $this->dat[$i-1];
                $vMap[] = $this->value[$i-1];
                return $vMap;
            }
        }
        return false;
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

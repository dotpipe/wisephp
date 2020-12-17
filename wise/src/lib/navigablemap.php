<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

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
        return $bottom;
    }

    /**
     * public function navigableKeySet
     * @parameters string
     *
     */
    // Return all Keys
    public function navigableKeySet() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        return array_keys($this->dat);
    }

    /**
     * public function pollFirst
     * @parameters none
     *
     */
    // Get first entry in Map and remove
    public function pollFirst() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        return array_shift($this->dat);
    }

    /**
     * public function pollLast
     * @parameters none
     *
     */
    // Get last entry in Map and Remove
    public function pollLast() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        return array_pop($this->dat);
    }
}

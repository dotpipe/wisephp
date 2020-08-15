<?php declare (strict_types = 1);
namespace Adoms\src\lib;


require_once __DIR__ . '../../../../vendor/autoload.php';


class Set extends Common {

    public $setTemp;
    public $parentType;

    public function __construct() {
        $this->cache = array();
        $this->rootType = 'Container';
        $this->parentType = 'Set';
        $this->childType = 'Set';
        $this->typeOf = 'Set';
        $this->dat = array();
    }

    public function destroy() {
        $this->dat = null;
    }

    /**
     * public function addAll
     * @parameters string
     *
     */
    // Merge sets
    public function addAll(Set $r): bool {
        if ($this->typeOf != $r->typeOf) {
            throw new Type_Error('Mismatched Types');
            return false;
        }

        $s = $this->dat;
        $this->clear();
        $this->dat = array_merge($s,$r);
        $this->pt = current($this->dat);
        return true;
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    // Empty Set
    public function clear(): void {

        $this->dat = array();
        $this->pt = "";
        return;
    }

    /**
     * public function add
     * @parameters none
     *
     */
    // Splice $r into $indx point
    public function add($r): bool {
        $bool = true;
        (in_array($r, $this->dat)) ? $bool = false : array_push($this->dat, $r);
        return $bool;
    }

    /**
     * public function valIsIn
     * @parameters string
     *
     */
    // Return if Value exists
    public function valIsIn(string $v) {
        return array_search($v, $this->dat);
    }

    /**
     * public function compare
     * @parameters Set
     *
     */
    // Compare $this with $r
    public function compare(Set $r): bool {
        $temp = array();
        if ($this->typeOf != $r->typeOf) {
            throw new Type_Error('Mismatched Types');
            return false;
        }
        if ($r->size() != $this->size() || $r->dat != $this->dat)
            return false;
        return true;
    }

    /**
     * public function get
     * @parameters int
     *
     */
    // Return entry at $indx
    public function get(int $indx) {
        if ($this->size() == 0 || $indx >= $this->size()) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }
        return $this->dat[$indx];
    }

    /**
     * public function exists
     * @parameters string
     *
     */
    // Return Index of Entry
    public function exists(string $r) {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }
        return array_search($r,$this->dat);
    }

    /**
     * public function remIndex
     * @parameters int
     *
     */
    // Remove Entry at $indx
    public function remIndex(int $indx):bool {
        $setTemp = [];
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }
        array_splice($this->dat,$indx,1);
        return true;
    }

    /**
     * public function remValue
     * @parameters string
     *
     */
    // Remove Value if exists (otherwise 0)
    public function remValue(string $val):bool {
        $setTemp = [];
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }
        array_splice($this->dat,array_search($val,$this->dat),1);
        $this->pt = current($this->dat);
        return true;
    }

}

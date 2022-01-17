<?php declare (strict_types = 1);
namespace src\lib;


require_once(__DIR__."/../../../vendor/autoload.php");


class Set extends Common {

    public $setTemp;
    public $parentType;

    /**
     * @method __construct
     * @param none
     * @return void
     * 
     * common init
     */
    public function __construct() {
        $this->cache = array();
        $this->rootType = 'Container';
        $this->parentType = 'Set';
        $this->childType = 'Set';
        $this->typeOf = 'Set';
        $this->dat = array();
    }

    /**
     * @method destroy
     * @param none
     * 
     * destroy information
     */
    public function destroy() {
        $this->dat = null;
    }

    /**
     * @method addAll
     * @param Set
     *
     * Merge sets
     */
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
     * @method clear
     * @param none
     *
     *
     * Empty Set
     */
    public function clear(): void {

        $this->dat = array();
        $this->pt = "";
        return;
    }

    /**
     * @method add
     * @param none
     *
     *
     * Splice $r into $indx point
     */
    public function add($r): bool {
        $bool = true;
        (in_array($r, $this->dat)) ? $bool = false : array_push($this->dat, $r);
        return $bool;
    }

    /**
     * @method valIsIn
     * @param string
     *
     *
     * Return if Value exists
     */
    public function valIsIn(string $v) {
        return array_search($v, $this->dat);
    }

    /**
     * @method compare
     * @param Set
     *
     *
     * Compare $this with $r
     */
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
     * @method get
     * @param int
     *
     *
     * Return entry at $indx
     */
    public function get(int $indx) {
        if ($this->size() == 0 || $indx >= $this->size()) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }
        return $this->dat[$indx];
    }

    /**
     * @method exists
     * @param string
     *
     *
     * Return Index of Entry
     */
    public function exists(string $r) {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }
        return array_search($r,$this->dat);
    }

    /**
     * @method remIndex
     * @param int
     *
     *
     * Remove Entry at $indx
     */
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
     * @method remValue
     * @param string
     *
     *
     * Remove Value if exists (otherwise 0)
     */
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

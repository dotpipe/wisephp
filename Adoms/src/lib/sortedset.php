<?php declare (strict_types = 1);
namespace Adoms\src\lib;


class SortedSet extends Set {

    public $sSetTemp;
    public $parentType;

    public function __construct() {
        $this->cache = array();
        $this->rootType = 'Container';
        $this->parentType = 'Set';
        $this->childType = 'Set';
        $this->typeOf = 'SortedSet';
        $this->dat = array();
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy() {
        $this->dat = null;
    }

    /**
     * public function headSet
     * @parameters int
     *
     */
    // Return entries before $indx
    public function headSet(int $indx) {
        if (!is_array($this->dat))
            $this->dat = [];
        $j = array_slice($this->dat, 0, $indx);
        return $j;
    }

    /**
     * public function first
     * @parameters none
     *
     */
    // Returns first Entry
    public function first() {
        if (!is_array($this->dat))
            $this->dat = [];
        $t = $this->dat;
        reset($t);
        return current($t);
    }

    /**
     * public function last
     * @parameters none
     *
     */
    // Returns last Entry
    public function last() {
        if (!is_array($this->dat))
            $this->dat = [];
        $t = $this->dat;
        end($t);
        return current($t);
    }

    /**
     * public function loadJSON
     * @parameters string, int, string, int
     *
     */
    // Return between $st and $en (This is very functional)
    // $Lb == 1 >= $st ; $Lb == 0 < $st
    // $Hb == 0 >= $en ; $Hb == < $en
    public function subSet(int $st, int $Lb, string $en, int $Hb) {
        $sSetTemp = new Set();
        if (!is_array($this->dat))
            $this->dat = [];
            
        if ($Lb == 1) {
            foreach ($this->dat as $v) {
                if ($v >= $ven) {
                    $sSetTemp = $sSetTemp->add($v);
                }
            }
        }
        else if ($Lb == 0) {
            foreach ($this->dat as $v) {
                if ($v > $ven) {
                    $sSetTemp = $sSetTemp->add($v);
                }
            }
        }
        if ($Hb == 1) {
            foreach ($this->dat as $v) {
                if ($v <= $ven) {
                    $sSetTemp = $sSetTemp->add($v);
                }
            }
        }
        else if ($Hb == 0) {
            foreach ($this->dat as $k => $v) {
                if ($v < $ven) {
                    $sSetTemp = $sSetTemp->add($v);
                }
            }
        }
        else {
            throw new SyntaxError('Invalid Syntax');
            return false;
        }
        return $sSetTemp;
    }
}
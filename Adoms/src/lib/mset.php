<?php declare (strict_types = 1); declare (strict_types = 1);
namespace Adoms\src\lib;



class mSet extends Set {

    public $setTemp;
    public $parentType;
    public $childType;
    public $datCntr;
    public $pt;
    public $set;
    public $dat;

    public function __construct(string $type) {
        $this->cache = array();
        $this->rootType = 'Container';
        $this->parentType = 'mSet';
        $this->typeOf = 'Set';
        $this->childType = $type;
        $this->datCntr = 0;
        $this->pt = -1;
        $this->dat = array();
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear() {

        $this->dat = null;
        return;
    }

    /**
     * public function get
     * @parameters int
     *
     */
    public function get(int $indx) {
        if (!is_array($this->dat))
            $this->dat = [];

        return array_slice($this->dat, $indx,1);
    }

    /**
     * public function addSet
     * @parameters Set
     *
     */
    public function addSet(Set $r) {
        if (!is_array($this->dat))
            $this->dat = [];
        if ($r->typeOf != $this->childType) {
            if ($this->strict == 1) throw new Type_Error('Incorrect Type');
            return false;
        }
        $h = 1;
        $t = 0;
        $r_temp = $r->dat;
        sort($r_temp);
        for ($i = 0; $i < $this->size(); $i++) {
            $temp = $this->dat[$i]->dat;
            sort($temp);
            if ($temp != $r_temp)
                $t++;
        }
        if ($t == $this->size()) {
            $this->dat[] = $r;
            $this->sync();
            return true;
        }
        return false;
    }

    /**
     * public function exists
     * @parameters Set
     *
     */
    public function exists(string $r) {
        if (!is_array($this->dat))
            $this->dat = [];
        $indx = array();
        $temp = array();
        for ($i = 0; $i < $this->size(); $i++) {
            $temp = $this->dat[$i];
            for ($j = 0 ; $j < sizeof($temp->dat) ; $j++) {
                if ($temp->dat[$j] == $r) {
                    $indx[] = array($i, $j);
                    break;
                }
            }
        }
        return $indx;
    }

    /**
     * public function remIndex
     * @parameters int
     *
     */
    public function remIndex(int $indx) {
        $setTemp = new mSet();
        if (!is_array($this->dat))
            $this->dat = [];

        $i = 0;
        $t = $this->dat;
        reset($t);
        $m = new mSet();
        while ($i < count($t)) {
            if ($i != $indx)
                $m->addSet(current($t));
            next($t);
            $i++;
        }
        $this->dat = $m->dat;
        $this->sync();
        return true;
    }

    /**
     * public function sync
     * @parameters none
     *
     */
    public function sync() {
        if (!is_array($this->dat))
            $this->dat = [];
        $this->dat = current($this->dat);
        $this->pt = $this->datCntr;
        return true;
    }
}

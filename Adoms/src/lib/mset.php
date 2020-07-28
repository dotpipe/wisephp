<?php declare (strict_types = 1); declare (strict_types = 1);
namespace Adoms\src\lib;

require_once '../../vendor/autoload.php';


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
    public function clear(): void {

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

        return array_search($indx,$this->dat, 1);
    }

    /**
     * public function addSet
     * @parameters Set
     *
     */
    public function addSet(Set $r): bool {
        if (!is_array($this->dat))
            $this->dat = [];
        if ($r->typeOf != $this->childType) {
            if ($this->strict == 1) throw new Type_Error('Incorrect Type');
            return false;
        }
        $handler = $this->setExists($r);
        if ($handler == FALSE) {
            array_push($this->dat, $r);
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
    public function setExists(Set $read_in): bool {
        if (!is_array($this->dat))
            $this->dat = [];
        foreach ($this->dat as $t => $val0) {
            if (isset($val0->dat) && array_diff_assoc($val0->dat,$read_in->dat) == array())
                return true;
        }
        return false;
    }

    /**
     * public function remIndex
     * @parameters int
     *
     */
    public function remIndex(int $indx):bool {
        if (!is_array($this->dat))
            $this->dat = [];
        $keys = array_keys($this->dat);
        if (\in_array($k,$keys))
            unset($this->dat[$indx]);
        else
            return 0;
        $this->sync();
        return true;
    }
/*
    /**
     * public function sync
     * @parameters none
     *
     
    public function sync() {
        if (!is_array($this->dat))
            $this->dat = [];
        $this-> = current($this->dat);
        $this->pt = $this->datCntr;
        return true;
    }
    */
}

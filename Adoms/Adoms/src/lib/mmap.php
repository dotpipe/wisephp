<?php
namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);
// $this->mmap is the set of Maps
//This is the Map-in-Map Extension
class mMap extends Map implements Classes {
    public $val;
    public $kv;
    public $dat;
    // Maps array()
    public $map;
    // Index integer
    public $datCntr;
    public $reglist;
    public $regreturn;
    // Current joined map
    public $mmap;
    public $mname;
    public $pm;
    public $cnt;

    public function __construct() {
        $this->parentType = 'mMap';
        $this->rootType = 'Container';
        $this->cache = new Vector('Map');
        $this->datCntr = 0;
        $this->mname = null;
        $this->pm = -1;
        $this->cnt = -1;
        $this->typeOf = 'mMap';
    }
    
    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy(): bool {
        $this->datCntr = null;
        $this->cache = null;
        $this->typeOf = null;
        $this->parentType = null;
        $this->rootType = null;
        $this->dat = null;
        $this->pt = -1;
        return true;
    }
    /**
     * public function size
     * @parameters none
     *
     */
    public function size(): int {
        $j = 0;
        return sizeof($this->dat);
    }
    /**
     * public function getMap
     * @parameters string
     *
     */
    public function getMap(string $regex): array {
        $reglist = array();
        $tmp = $this->dat;
        reset($tmp);
        $i = 0;
        while ($i < count($tmp)) {
            if (preg_match($regex, key($tmp))) {
                $reglist[] = array(key($tmp) => current($tmp));
            }
            next($tmp);
            $i++;
        }
        return $reglist;
    }

    /**
     * public function newMap
     * @parameters string, mixed
     *
     */
    public function newMap(string $key, $r): bool {
        $t = [];
        if ($this->dat == null) {
            $this->dat = [];
            $this->dat = array($key => $r);
            return true;
        }
        foreach ($this->dat as $x=>$y) {
            $t = array_merge($this->dat, array($x => $y));
        }
        $t = array_merge($t, array($key => $r));
        $this->dat = $t;
        return true;
    }
    
    /**
     * public function findKey
     * @parameters string
     *
     */
    public function findKey(string $regex): array {
        $reglist = array();
        $x = getIndex();
        $this->setIndex(0);
        do {
            $t = $this->mmap;
            $reglist[] = $t->findKey($regex);

        } while ($this->Iter());
        $regreturn = $reglist;
        $this->setIndex($x);
        if (sizeof($reglist) == 0)
            return false;
        return $regreturn;
    }

    /**
     * public function setIndex
     * @parameters int
     *
     */
    public function setIndex(int $indx): bool {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        $i = 0;
        reset($this->dat);
        $this->datCntr = 0;
        if (count($this->dat) <= $indx) {
            end($this->dat);
            $this->datCntr = count($this->dat)-1;
            $this->sync();
        }
        else {
            while ($this->datCntr < count($this->dat) && $indx >= $i) {
                $this->Iter();
                $i++;
            }
            $this->sync();
        }
        return true;
    }
    
    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear(): bool {
        $this->mmap = array();
        return true;
    }

    /**
     * public function keyIsIn
     * @parameters string
     *
     */
    public function keyIsIn(string $k): int {
        if (count($this->dat) == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        $tmp = $this->dat;
        reset($tmp);
        $i = 0;
        while ($i < count($this->dat)) {
            if (key($tmp) == $k)
                return $i;
            $i++;
        }
        return -1;
    }
    /**
     * public function equals
     * @parameters Map
     *
     */
    public function equals(Map $r): bool {
        if ($r->typeOf != 'Map') {
            throw new Type_Error('Mismatched Types');
            return false;
        }
        if ($r->size() != $this->size())
            return false;
        for ($i = 0; $i < $this->size(); $i++) {
            if (!($this->keyIsIn($r[$i])))
                return false;
        }
        return true;
    }
    /**
     * public function get
     * @parameters string
     *
     */
    public function get(string $k) {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        $x = $this->getIndex();
        do {
            if (key($this->dat) == $k)
                return current($this->dat);
        } while ($this->Iter());
        $this->setIndex($x);
        return false;
    }
    /**
     * public function isEmpty
     * @parameters none
     *
     */
    public function isEmpty(): bool {
        if (count($this->dat) == 0)
            return true;
        else
            return false;
    }
    /**
     * public function addAll
     * @parameters string
     *
     */
    public function addAll(mMap $r): bool {
        if ('NavigableMap' != $r->typeOf && 'SortedMap' != $r->typeOf && 'Map' != $r->typeOf) {
            throw new Type_Error('Mismatched Types');
            return false;
        }
        do {
            $this->add($r->mname, $r->mmap);
        } while ($r->Iter());
        return true;
    }
    /**
     * public function remove
     * @parameters string
     *
     */
    public function remove(string $k): bool {
        $mapTempK = array();
        $mapTempV = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        for ($i = 0; $i < $this->size(); $i++) {
            if ($this->at($i) != $k) {
                $mapTempK = array_merge($mapTempK, $this->at($i));
            }
        }
        if (sizeof($mapTempK) == 0)
            return false;
        $this->dat = $mapTempK;
        return true;
    }
    /**
     * public function replace
     * @parameters string, string
     *
     */
    public function mapReplace(string $k, Map $v): bool {
        if ($this->typeOf != $v->typeOf)
            return false;
        do {
            if ($this->pt[0] == $k) {
                $this->pt[1] = $v;
                return true;
            }
        } while($this->Iter());
        return true;
    }
    
}

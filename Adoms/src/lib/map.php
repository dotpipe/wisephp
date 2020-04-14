<?php declare (strict_types = 1);
namespace Adoms\src\lib;

class Map extends Common
{

    public $mapTempK;
    public $mapTempV;
    public $vMap;
    // Holds keys
    public $dat = array();
    // for future
    public $keyType;
    public $valueType;
    // Holds all Map entries
    public $map;
    public $datCntr;
    public $pm;
    public $childType;
    public $parentType;
    public $strict;

    public function __construct()
    {
        $this->rootType = 'Container';
        $this->parentType = 'Map';
        $this->childType = 'Map';
        $this->typeOf = 'Map';
        $this->pm = -1;
        $this->pt = array();
        $this->dat = array();
        $this->datCntr = 0;
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy()
    {
        $this->cache = null;
        $this->dat = array();
        $this->pt = null;
    }

    /**
     * public function size
     * @parameters none
     *
     */
    public function size(): int
    {
        if (!is_array($this->dat)) {
            $this->dat = [];
        }
        if (count($this->dat) > 0) {
            return count($this->dat);
        }
        return 0;
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear(): bool
    {
        $this->pt = array();
        $this->dat = array();
        return true;
    }

    /**
     * public function at
     * @parameters int
     *
     */
    public function at(int $indx)
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return false;
        }
        $temp = array();
        if ($indx >= $this->size() || $indx < 0) {
            return false;
        }
        $temp = array_slice($this->dat, $indx, 1);
        return $temp;
    }

    /**
     * public function Sorter
     * @parameters none
     *
     */
    public function Sorter(): bool
    {
        if ($this->size() > 0) {
            $vals = &$this->dat;
            sort($vals);
            return true;
        }
        return false;
    }

    /**
     * public function keyIsIn
     * @parameters string
     *
     */
    public function keyIsIn(string $k)
    {
        return array_keys($this->dat, $k);
    }

    /**
     * public function valisIn
     * @parameters string
     *
     */
    public function valIsIn(string $v)
    {
        $y = null;
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return false;
        }
        array_flip($this->dat);
        $e = $this->keyIsIn($v);
        array_flip($this->dat);

        return $e;
    }

    /**
     * public function equals
     * @parameters Map
     *
     */
    public function equals(Map $r): bool
    {
        if ($r->dat == $this->dat) {
            return true;
        }
        return false;
    }

    /**
     * public function get
     * @parameters string
     *
     */
    public function get(string $k)
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return false;
        }
        $t = $this->dat;
        reset($t);
        if ($this->keyIsIn($k)) {
            for ($j = 0; $j < count($t); $j++) {
                if (key($t) != $k) {
                    next($t);
                } else {
                    break;
                }
            }
        }
        else return false;
        return current($t);
    }

    /**
     * public function isEmpty
     * @parameters none
     *
     */
    public function isEmpty(): bool
    {
        return (count($this->dat) == 0) ? true : false;
    }

    /**
     * public function mergeAll
     * @parameters array
     * Merge maps -returns number inserted
     */
    public function mergeAll(array $r): bool
    {
        if ($this->typeOf != $r->typeOf) {
            throw new Type_Error('Mismatched Types');
            return false;
        }
        $this->dat = array_merge($this->dat, $r);
        if (($this->typeOf == 'SortedMap' || $this->typeOf == 'NavigableMap') && $this->parentType == 'Map') {
            $this->Sorter();
        }
        if ($this->size() == 1) {
            $this->Iter();
        }
        return true;
    }

    /**
     * public function remove
     * @parameters string
     *
     */
    // Remove Key with name $k
    public function remove(string $k): bool
    {
        $temp = [];
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return false;
        }
        $tmp = $this->dat;
        reset($tmp);
        $i = 0;
        while ($i < count($tmp)) {
            if (key($tmp) != $k) {
                $temp = array_merge($temp, array(key($tmp) => current($tmp)));
            }
            next($tmp);
            $i++;
        }
        $this->dat = $temp;
        reset($this->dat);
        return true;
    }

    /**
     * public function findKey
     * @parameters string
     *
     */
    // Return Key

    // Return keys fitting $regex
    public function findKey(string $regex): array
    {
        $reglist = array();
        $tmp = $this->dat;
        reset($tmp);
        $i = 0;
        while ($i < count($tmp)) {
            if (preg_match_all($regex, key($tmp))) {
                array_push($reglist, array(key($tmp) => current($tmp)));
            }
            next($tmp);
            $i++;
        }
        $regs = [];
        foreach ($reglist as $t) {
            $regs = array_merge($regs, $t);
        }
        return $regs;
    }

    /**
     * public function removedat
     * @parameters string, string
     *
     */
    // Remove entry with K & V matching $k and $v
    public function removedat($k, $v): bool
    {
        $mtdat = array();
        $tmp = $this->dat;
        end($tmp);
        $i = 0;
        while ($i < count($tmp)) {
            if (key($tmp) != $k && current($tmp) != $v) {
                $mtk = array_merge($mtk, array(key($tmp) => current($tmp)));
            }
            next($tmp);
            $i++;
        }
        $this->dat = $mtk;
        return true;
    }

    /**
     * public function replace
     * @parameters string, string
     *
     */
    // Replace dat
    public function replace(string $k, $v): bool
    {
        $this->add($k, $v);
        return true;
    }

    /**
     * public function add
     * @parameters string, mixed
     *
     */
    // Add entry
    public function add(string $key, $val): bool
    {
        $t = array();
        if ($this->dat == null || (is_array($this->dat) && sizeof($this->dat) == 0)) {
            $this->dat = array_merge($t, array($key =>  ($val)));
            $this->datCntr = 0;
        }
        foreach ($this->dat as $x => $y) {
            if (isset($x) && isset($y)) {
                $t = array_merge($t, array($x => $y));
            }
        } 
        if (isset($key) && isset($val)) {
            $t = array_merge($t, array((string) $key => $val));
        }
        reset($t);
        for ($i = 0; $i < $this->datCntr; $i++) {
            next($t);
        }
        $this->dat = $t;
        $this->sync();
        return true;
    }

}

<?php declare (strict_types = 1);
namespace Adoms\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

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
    public function clear(): void
    {
        $this->pt = array();
        $this->dat = array();
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
        return array_keys($this->dat);
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
        if ((string)$this->typeOf != (string)($r->typeOf)) {
            throw new Type_Error('Mismatched Types');
            return false;
        }
        $this->dat = array_merge($this->dat, $r);
        if (($this->typeOf == 'SortedMap' || $this->typeOf == 'NavigableMap') && $this->parentType == 'Map') {
            $this->Sorter();
        }
        if ($this->size() == 1) {
            $this->Cycle();
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
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return false;
        }
        $rem = array_search($k,$this->dat);
        unset($this->dat[$rem]);
        return true;
    }

    /**
     * public function findKey
     * @parameters string
     *
     */
    // Return Key

    // Return keys fitting $regex
    public function findKey(string $r)
    {
        if (($y = array_search($r,array_keys($this->dat))) != false);
            return $y;
        return false;
    }

    /**
     * public function removedat
     * @parameters string, string
     *
     */
    // Remove entry with K & V matching $k and $v
    public function removedat($k, $v): bool
    {
        if (($y = array_search($k,$this->dat)) != false)
        {
            if ($this->dat[$k] == $v)
                unset($this->dat[$k]);
            else
                return false;
            return true;
        }
        else
            return false;
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
        $this->dat[$key] = $val;
        return true;
    }

}

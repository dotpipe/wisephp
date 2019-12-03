<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


class Map implements Classes
{

    public $mapTempK;
    public $mapTempV;
    public $vMap;
    // Holds keys
    public $kv = array();
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
        $this->map = null;
        $this->kv = array();
        $this->dat = array();
        $this->datCntr = 0;
    }

    /**
     * public function save
     * @parameters string
     *
     */
    public function save(string $file_name): bool
    {
        $fp = fopen("$file_name", "w");
        fwrite($fp, serialize($this));
        fclose($fp);
        return 1;
    }

    /**
     * public function loadJSON
     * @parameters string
     *
     */
    public function loadJSON(string $file_name): bool
    {
        if (file_exists("$file_name") && filesize("$file_name") > 0)
            $fp = fopen("$file_name", "r");
        else
            return 0;
        $json_context = fread($fp, filesize("$file_name"));
        $old = unserialize($json_context);
        $b = $old;
        foreach ($b as $key => $val) {
            $this->$key = $b->$key; //addModelData($old->view, array($key, $val));
        }
        return 1;
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy()
    {
        $this->cache = null;
        $this->kv = null;
        $this->map = null;
    }

    /**
     * public function size
     * @parameters none
     *
     */
    public function size(): int
    {
        if (!is_array($this->kv)) {
            $this->kv = [];
        }
        if (count($this->kv) > 0) {
            return count($this->kv);
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
        $this->map = array();
        $this->kv = array();
        return 1;
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
            return 0;
        }
        $temp = array();
        if ($indx >= $this->size() || $indx < 0) {
            return 0;
        }
        $temp = array_slice($this->kv, $indx, 1);
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
            $vals =& $this->kv;
            sort($vals);
            return 1;
        }
        return 0;
    }

    /**
     * public function keyIsIn
     * @parameters string
     *
     */
    public function keyIsIn(string $k)
    {
        return array_keys($k,$this->kv);
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
            return 0;
        }
        array_flip($this->kv);
        $e = $this->keyIsIn($v);
        array_flip($this->kv);

        return $e;
    }

    /**
     * public function equals
     * @parameters Map
     *
     */
    public function equals(Map $r): bool
    {
        if ($r->kv == $this->kv) {
            return 1;
        }
        return 0;
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
            return 0;
        }
        $t = $this->kv;
        reset($t);
        for ($j = 0; $j < count($t); $j++) {
            if (key($t) != $k) {
                next($t);
            }
            else {
                break;
            }
        }
        return current($t);
    }

    /**
     * public function isEmpty
     * @parameters none
     *
     */
    public function isEmpty(): bool
    {
        return (count($this->kv) === 0) ? 1 : 0;
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
            return 0;
        }
        $this->kv = array_merge($this->kv, $r);
        if (($this->typeOf == 'SortedMap' || $this->typeOf == 'NavigableMap') && $this->parentType == 'Map') {
            $this->Sorter();
        }
        if ($this->size() == 1) {
            $this->Iter();
        }
        return 1;
    }

    /**
     * public function current
     * @parameters none
     *
     */
    // Retrieve current Index of Vector Pointer
    public function current(): int
    {
        return $this->getIndex();
    }

    /**
     * public function prev
     * @parameters none
     *
     */
    // Iterate to Previous key
    public function prev()
    {
        if ($this->datCntr > 0 && $this->datCntr < count($this->kv)) {
            $this->datCntr--;
        } else {
            return 0;
        }
        return prev($this->kv);
    }

    /**
     * public function next
     * @parameters none
     *
     */
    // Iterate to Previous key;
    public function next()
    {
        if ($this->datCntr > 0 && $this->datCntr+1 < count($this->kv)) {
            $this->datCntr++;
        } else {
            return 0;
        }
        return next($this->kv);
    }

    /**
     * public function getIndex
     * @parameters int
     *
     */
    // Sets and Joins Map Index
    public function getIndex(): int
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return 0;
        }
        return $this->datCntr;
    }

    /**
     * public function setIndex
     * @parameters int
     *
     */
    // Sets and Joins Map Index
    public function setIndex(int $indx): bool
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return 0;
        }
        $i = 0;
        reset($this->kv);
        $this->datCntr = 0;
        if (count($this->kv) <= $indx + 1) {
            end($this->kv);
        } else {
            do {
                $i++;
            } while ($this->Iter() && $indx >= $i);
        }
        return 1;
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
            return 0;
        }
        $tmp = $this->kv;
        reset($tmp);
        $i = 0;
        while($i < count($tmp)) {
            if (key($tmp) != $k) {
                $temp = array_merge($temp, array(key($tmp) => current($tmp)));
            }
            next($tmp);
            $i++;
        }
        $this->kv = $temp;
        reset($this->kv);
        return 1;
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
        $tmp = $this->kv;
        reset($tmp);
        $i = 0;
        while ($i < count($tmp)) {
            if (preg_match_all($regex, key($tmp))) {
                $reglist[] = array(key($tmp) => current($tmp));
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
     * public function removeKV
     * @parameters string, string
     *
     */
    // Remove entry with K & V matching $k and $v
    public function removeKV($k, $v): bool
    {
        $mtkv = array();
        $tmp = $this->kv;
        end($tmp);
        $i = 0;
        while ($i < count($tmp)) {
            if (key($tmp) != $k && current($tmp) != $v) {
                $mtk = array_merge($mtk, array(key($tmp) => current($tmp)));
            }
            next($tmp);
            $i++;
        }
        $this->kv = $mtk;
        return 1;
    }

    /**
     * public function replace
     * @parameters string, string
     *
     */
    // Replace KV
    public function replace(string $k, $v): bool
    {
        $this->add($k,$v);
        return 1;
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
        if ($this->kv == null || count($this->kv) == 0) {
            $this->kv = array($key => $val);
            return 1;
        }
        foreach ($this->kv as $x=>$y) {
            if (isset($x) && isset($y))
                $t = array_merge($t, array($x => $y));
        }
        if (isset($key) && isset($val)) {
            $t = array_merge($t, array((string)$key => $val));
        }
        reset($t);
        for ($i = 0 ; $i < $this->datCntr ; $i++) {
            next($t);
        }
        $this->kv = $t;

        return 1;
    }

    /**
     * public function Iter
     * @parameters none
     *
     */
    public function Iter(): bool
    {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->kv)) {
            if (isset($this->map)) {
                $this->add($this->map[0], $this->map[1]);
            }
            next($this->kv);
            $this->datCntr++;
            $this->map = array(key($this->kv), current($this->kv));
            return 1;
        }
        return 0;
    }

    /**
     * public function revIter
     * @parameters none
     *
     */
    public function revIter(): bool
    {
        if ($this->datCntr > 0 && $this->datCntr + 1 < count($this->kv)) {
            if (is_array($this->map) || $this->map[0] != null) {
                $this->add($this->map[0], $this->map[1]);
            }
            prev($this);
            $this->datCntr--;
            $this->map = array(key($this->kv), current($this->kv));
            return 1;
        }
        return 0;
    }

    /**
     * public function Iter
     * @parameters none
     *
     */
    public function Cycle(): bool
    {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->kv)) {
            if (isset($this->map)) {
                $this->add($this->map[0], $this->map[1]);
            }
            next($this->kv);
            $this->datCntr++;
            $this->map = array(key($this->kv), current($this->kv));
            return 1;
        } elseif (count($this->kv) > 0) {
            if (isset($this->map)) {
                $this->add($this->map[0], $this->map[1]);
            }
            reset($this->kv);
            $this->datCntr = 0;
            $this->map = array(key($this->kv), current($this->kv));
        }
        return 0;
    }

    /**
     * public function revIter
     * @parameters none
     *
     */
    public function revCycle(): bool
    {
        if ($this->datCntr > 0 && $this->datCntr + 1 < count($this->kv)) {
            if (is_array($this->map) || $this->map[0] != null) {
                $this->add($this->map[0], $this->map[1]);
            }
            prev($this);
            $this->datCntr--;
            $this->map = array(key($this->kv), current($this->kv));
            return 1;
        } elseif (count($this->kv) > 0) {
            if (isset($this->map)) {
                $this->add($this->map[0], $this->map[1]);
            }
            end($this->kv);
            $this->datCntr = 0;
            $this->map = array(key($this->kv), current($this->kv));
        }
        return 0;
    }

}

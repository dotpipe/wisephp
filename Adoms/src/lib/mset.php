<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


class mSet extends Set implements Classes {

    public $setTemp;
    public $parentType;
    public $childType;
    public $datCntr;
    public $sv;
    public $set;
    public $sets;

    public function __construct(string $type) {
        $this->cache = array();
        $this->rootType = 'Container';
        $this->parentType = 'mSet';
        $this->typeOf = 'Set';
        $this->childType = $type;
        $this->datCntr = 0;
        $this->sv = -1;
        $this->dat = null;
        $this->sets = array();
    }

    /**
     * public function save
     * @parameters string
     *
     */
    public function save(string $json_name) {
        $fp = fopen("$json_name", "w");
        fwrite($fp, serialize($this));
        fclose($fp);
        return 1;
    }

    /**
     * public function loadJSON
     * @parameters string
     *
     */
    public function loadJSON(string $json_name) {
        if (file_exists("$json_name") && filesize("$json_name") > 0)
            $fp = fopen("$json_name", "r");
        else
            return 0;
        $json_context = fread($fp, filesize("$json_name"));
        $old = unserialize($json_context);
        $b = $old;
        foreach ($b as $key => $val) {
            $this->$key = $b->$key;
        }
        return 1;
    }

    /**
     * public function size
     * @parameters none
     *
     */
    public function size() {
        return count($this->sets);
    }

    /**
     * public function getIndex
     * @parameters none
     *
     */
    public function getIndex() {
        return $this->datCntr;
    }

    /**
     * public function setIndex
     * @parameters int
     *
     */
    public function setIndex(int $indx) {
        reset($this->sets);
        if ($indx == count($this->sets) - 1)
            end($this->sets);
        else
            for ($i = 0 ; $i < $indx ; $i++)
                next($this->sets);
        $this->datCntr = $indx;
    }

    /**
     * public function Iter
     * @parameters none
     *
     */
    public function Iter() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        next($this->sets);
        return 1;

    }

    /**
     * public function Cycle
     * @parameters none
     *
     */
    public function Cycle() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr++;
        else
            return 0;
        next($this->sets);

        return 1;
    }

    /**
     * public function revIter
     * @parameters none
     *
     */
    public function revIter() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        prev($this->sets);

        return 1;
     }

    /**
     * public function revCycle
     * @parameters none
     *
     */
    public function revCycle() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        prev($this->sets);

        return 1;
    }

    /**
     * public function prev
     * @parameters none
     *
     */
    public function prev() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        return prev($this->sets);
    }
    /**
     * public function next
     * @parameters none
     *
     */
    public function next() {
        if ($this->datCntr > 0 && $this->datCntr+1 < count($this->sets))
            $this->datCntr++;
        else
            return 0;
        return next($this->sets);
    }

    /**
     * public function current
     * @parameters none
     *
     */
    public function current() {
        return $this->getIndex();
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear() {

        $this->sets = null;
        return;
    }

    /**
     * public function get
     * @parameters int
     *
     */
    public function get(int $indx) {
        if (!is_array($this->sets))
            $this->sets = [];

        return array_slice($this->sets, $indx,1);
    }

    /**
     * public function addSet
     * @parameters Set
     *
     */
    public function addSet(Set $r) {
        if (!is_array($this->sets))
            $this->sets = [];
        if ($r->typeOf != $this->childType) {
            if ($this->strict == 1) throw new Type_Error('Incorrect Type');
            return 0;
        }
        $h = 1;
        $t = 0;
        $r_temp = $r->dat;
        sort($r_temp);
        for ($i = 0; $i < $this->size(); $i++) {
            $temp = $this->sets[$i]->dat;
            sort($temp);
            if ($temp != $r_temp)
                $t++;
        }
        if ($t == $this->size()) {
            $this->sets[] = $r;
            $this->sync();
            return 1;
        }
        return 0;
    }

    /**
     * public function exists
     * @parameters Set
     *
     */
    public function exists(string $r) {
        if (!is_array($this->sets))
            $this->sets = [];
        $indx = array();
        $temp = array();
        for ($i = 0; $i < $this->size(); $i++) {
            $temp = $this->sets[$i];
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
        if (!is_array($this->sets))
            $this->sets = [];

        $i = 0;
        $t = $this->sets;
        reset($t);
        $m = new mSet();
        while ($i < count($t)) {
            if ($i != $indx)
                $m->addSet(current($t));
            next($t);
            $i++;
        }
        $this->sets = $m->sets;
        $this->sync();
        return 1;
    }

    /**
     * public function sync
     * @parameters none
     *
     */
    public function sync() {
        if (!is_array($this->sets))
            $this->sets = [];
        $this->dat = current($this->sets);
        $this->sv = $this->datCntr;
        return 1;
    }
}

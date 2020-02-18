<?php
namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);



class Set {

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
     * public function save
     * @parameters string
     *
     */
    public function save(string $json_name) {
        $fp = fopen("$json_name", "w");
        fwrite($fp, serialize($this));
        fclose($fp);
        return true;
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
            return false;
        $json_context = fread($fp, filesize("$json_name"));
        $old = unserialize($json_context);
        $b = $old;
        foreach ($b as $key => $val) {
            $this->$key = $b->$key; //addModelData($old->view, array($key, $val));
        }
        return true;
    }

    /**
     * public function size
     * @parameters none
     *
     */
    // Report Size of Container
    public function size() {
        if (($this->typeOf == 'SortedSet' || $this->typeOf == 'NavigableSet') && $this->parentType == 'Set') {

            sort($this->dat);
        }
        if (sizeof($this->dat) >= 0)
            return sizeof($this->dat);
        else return -1;
    }

    /**
     * public function addAll
     * @parameters string
     *
     */
    // Merge sets
    public function addAll(string $r) {
        if ($this->typeOf != $r->typeOf) {
            throw new Type_Error('Mismatched Types');
            return false;
        }

        $s = $this->dat;
        $this->clear();
        for ($i = 0; $i < sizeof($r->dat); $i++)
            $this->add($r->dat[$i]);
        for ($i = 0; $i < sizeof($s); $i++)
            $this->add($s[$i]);

    }

    /**
     * public function clear
     * @parameters none
     *
     */
    // Empty Set
    public function clear() {

        $this->dat = array();
        return;
    }

    /**
     * public function add
     * @parameters none
     *
     */
    // Splice $r into $indx point
    public function add($r) {
        $bool = 0;
        foreach ($this->dat as $x)
            if ($r == $x)
                $bool = 1;
        if ($bool == 0)
            $this->dat[] = $r;

        return true;
    }

    /**
     * public function valIsIn
     * @parameters string
     *
     */
    // Return if Value exists
    public function valIsIn(string $v) {
        $temp = array();
        return array_search($v, $this->dat);
    }

    /**
     * public function compare
     * @parameters Set
     *
     */
    // Compare $this with $r
    public function compare(Set $r) {
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

        $indx = -1;
        for ($i = 0; $i < $this->size(); $i++) {
            if ($this->dat[$i] == $r)
                $indx = $i;
        }
        return $indx;
    }

    /**
     * public function remIndex
     * @parameters int
     *
     */
    // Remove Entry at $indx
    public function remIndex(int $indx) {
        $setTemp = [];
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }

        $i = 0;
        reset($this->dat);
        while ($i < count($this->dat)) {
            if ($i != $indx)
                $setTemp[] = current($this->dat);
            next($this->dat);
            $i++;
        }
        $this->dat = $setTemp;
        return true;
    }

    /**
     * public function remValue
     * @parameters string
     *
     */
    // Remove Value if exists (otherwise 0)
    public function remValue(string $val) {
        $setTemp = [];
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Set');
            return false;
        }

        $i = 0;
        reset($this->dat);
        while ($i < count($this->dat)) {
            if ($current($this->dat) != $val)
                $setTemp[] = current($this->dat);
            next($this->dat);
            $i++;
        }
        $this->dat = $setTemp;
        return true;
    }

}

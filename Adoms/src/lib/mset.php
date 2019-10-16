<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className)
{
    $path1 = '/Adoms/src/lib/';
    $path2 = '';

    if (file_exists($path1.$className.'.php'))
        include $path1.$className.'.php';
    else
        include $path2.$className.'.php';
});

class mSet extends Set implements Classes {

    public $setTemp;
    public $parentType;
    public $childType;
    public $datCntr;
    public $sv;
    public $set;
    public $sets;

    public function __construct($type = "Set") {
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

    /*
    *
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

    /*
    *
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
            $this->$key = $b->$key; //addModelData($old->view, array($key, $val));
        }
        return 1;
    }

    /*
    *
    * public function size
    * @parameters none
    *
    */
    // Report Size of Container
    public function size() {
        return count($this->sets);
    }

    /*
    *
    * public function getIndex
    * @parameters none
    *
    */
    // Get Index
    public function getIndex() {
        return $this->datCntr;
    }

    /*
    *
    * public function setIndex
    * @parameters int
    *
    */
    // Sets and Joins Set Index
    public function setIndex(int $indx) {
        reset($this->sets);
        if ($indx == count($this->sets) - 1)
            end($this->sets);
        else
            for ($i = 0 ; $i < $indx ; $i++)
                next($this->sets);
        $this->datCntr = $indx;
    }

    /*
    *
    * public function Iter
    * @parameters none
    *
    */
    // Iterate Forward through Set
    public function Iter() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        next($this->sets);
        return 1;

    }

    /*
    *
    * public function Cycle
    * @parameters none
    *
    */
    // Cycle Forward through Vector
    public function Cycle() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr++;
        else
            return 0;
        next($this->sets);

        return 1;
    }

    /*
    *
    * public function revIter
    * @parameters none
    *
    */
    // Iterate Forward through Set
    public function revIter() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        prev($this->sets);

        return 1;
     }

    /*
    *
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

    /*
    *
    * public function prev
    * @parameters none
    *
    */
    // Iterate to Previous key
    public function prev() {
        if ($this->datCntr > 0 && $this->datCntr < count($this->sets))
            $this->datCntr--;
        else
            return 0;
        return prev($this->sets);
    }
    /*
    *
    * public function next
    * @parameters none
    *
    */
    // Iterate to Next key
    public function next() {
        if ($this->datCntr > 0 && $this->datCntr+1 < count($this->sets))
            $this->datCntr++;
        else
            return 0;
        return next($this->sets);
    }

    /*
    *
    * public function current
    * @parameters none
    *
    */
    // Retrieve current Index of Vector Pointer
    public function current() {
        return $this->getIndex();
    }

    /*
    *
    * public function clear
    * @parameters none
    *
    */
    // Empty Set
    public function clear() {

        $this->sets = null;
        return;
    }

    /*
    *
    * public function get
    * @parameters int
    *
    */
    // Return entry at $indx
    public function get(int $indx) {
        if (!is_array($this->sets))
            $this->sets = [];

        return array_slice($this->sets, $indx,1);
    }

    /*
    *
    * public function addSet
    * @parameters Set
    *
    */
    // Insert $r
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

    /*
    *
    * public function exists
    * @parameters Set
    *
    */
    // Return Indices of Entry
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

    /*
    *
    * public function remIndex
    * @parameters int
    *
    */
    // Remove Entry at $indx
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

    /*
    *
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

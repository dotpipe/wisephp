<?php declare (strict_types = 1);

namespace Adoms\src\lib; 

require_once __DIR__ . '../../../../vendor/autoload.php';

class Common {

    public $datCntr = 0;
    public $dat = array();
    public $pt = array();

    /**
     * public function save
     * @parameters string
     *
     */
    public function save(string $file_name): bool
    {
        file_put_contents($file_name, serialize(($this)));
        return true;
    }

    /**
     * public function size
     * @parameters none
     *
     */
    // Report Size of Container
    public function size(): int {
        if (sizeof($this->dat) >= 0)
            return sizeof($this->dat);
        else return -1;
    }

    /**
     * public function loadJSON
     * @parameters string
     *
     */
    public function loadJSON(string $file_name): bool
    {
        if (file_exists("$file_name") && filesize("$file_name") > 0)
        {}
        else {
            return false;
        }

        $json_context = file_get_contents($file_name);
        $old = unserialize($json_context);
        $b = $old;
        foreach ($b as $key => $val) {
            $this->$key = $val;
        }
        return true;
    }

    /**
     * public function current
     * @parameters none
     *
     * Retrieve current Index of Vector Pointer
     */
    public function current(): int
    {
        return $this->getIndex();
    }

    /**
     * public function getIndex
     * @parameters int
     *
     * Sets and Joins Map Index
     */
    public function getIndex(): int
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Map');
            }
            return 0;
        }
        return current($this->dat);
    }

    /**
     * public function setIndex
     * @parameters int
     *
     * Sets and Joins Map Index
     */
    public function setIndex(int $indx) {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Vector');
            return false;
        }
        if ($indx <= $this->size()) {
            reset($this->dat);
            for($i = 0 ; $i < $indx ; $i++)
                next($this->dat);
            $this->datCntr = $indx;
            $this->sync();
            return true;
        }
        return false;
    }

    /**
     * public function Iter
     * @parameters none
     *
     * Goto next $dat member
     */
    public function Iter(): bool
    {
        $typeArray = array("Map", "mMap", "Set", "mSet", "Streams");
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->dat)) {
            if (is_array($this->pt) && sizeof($this->pt) == 2 && 1 == count(array_intersect($typeArray, array($this->parentType)))) {
                $this->add($this->pt[0], $this->pt[1]);
            }
            else if (1 == count(array_intersect($typeArray, array($this->parentType)))) {
                next($this->dat);
                $this->pt = current($this->dat);
                $this->sync();
                $this->datCntr++;
                return true;
            }
            next($this->dat);
            $this->pt = current($this->dat);
            $this->datCntr++;
            $this->sync();
            return true;
        }
        return false;
    }

    /**
     * public function revIter
     * @parameters none
     *
     * Goto previous $dat member
     */
    public function revIter(): bool
    {
        $typeArray = array("Map", "mMap", "Set", "mSet");
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->dat)) {
            if (isset($this->pt) && 1 == count(array_intersect($typeArray, array($this->parentType)))) {
                $this->add($this->pt[0], $this->pt[1]);
            }
            prev($this->dat);
            $this->pt = current($this->dat);
            $this->datCntr--;
            $this->sync();
            return true;
        }
        return false;
    }

    /**
     * public function Cycle
     * @parameters none
     *
     * Goto next $dat member
     * Return once finished to the beginning
     */
    public function Cycle(): bool
    {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->dat)) {
            next($this->dat);
            $this->pt = current($this->dat);
            $this->datCntr++;
            $this->sync();
            return true;
        } 
        else {
            reset($this->dat);
            $this->pt = current($this->dat);
            $this->datCntr = 0;
            $this->sync();
            return false;
        }
    }

    /**
     * public function revCycle
     * @parameters none
     * Goto previous $dat member
     * Return to end aft reaching beginning
     */
    public function revCycle(): bool
    {
        if ($this->datCntr > 0 && $this->datCntr + 1 < count($this->dat)) {
            prev($this->dat);
            $this->pt = current($this->dat);
            $this->datCntr--;
            $this->sync();
            return true;
        } 
        else {
            end($this->dat);
            $this->pt = current($this->dat);
            $this->datCntr = sizeof($this->dat) - 1;
            $this->sync();
            return false;
        }
        return false;
    }
    
    /**
     * public function sync
     * @parameters none
     *
     * 
     */
    public function sync(): bool {
        $i = 0;
        reset($this->dat);
        while ($i < $this->datCntr) {
            next($this->dat);
            $i++;
        }
        $this->pt = current($this->dat);
        return true;
    }
}

?>
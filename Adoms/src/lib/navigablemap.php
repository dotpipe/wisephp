<?php declare (strict_types = 1);
namespace Adoms\src\lib;


class NavigableMap extends SortedMap {

    public $parentType;

    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Map';
        $this->typeOf = 'NavigableMap';
    }

    public function destroy() {
        $this->map = null;
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
            $this->$key = $b->$key; //addModelData($old->view, array($key, $val));
        }
        return 1;
    }

    /**
     * public function ceilKey
     * @parameters string
     *
     */
    // Return Values <= $r
    public function ceilKey(string $r) {
        $vMap = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1)
            return array($this->kv[0], $this->value[0]);
        for ($i = 0; $i < $this->size(); $i++) {
            if ($r <= $this->value[$i]) {
                $vMap[] = $this->kv[$i-1];
                $vMap[] = $this->value[$i-1];
                return $vMap;
            }
        }
        return 0;
    }

    /**
     * public function descKeySet
     * @parameters none
     *
     */
    // Descending Map Keys
    public function descKeySet() {
        $vMap = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1)
            return array($this->kv[0], $this->value[0]);
        $keys = $this->kv;
        rsort($keys, SORT_STRING);
        for ($i = 0; $i < $this->size(); $i++) {
            for ($j = $i; $j < $this->size(); $j++) {
                if ($keys[$i] == $this->kv[$j]) {
                    $mapTempK[] = $this->kv[$j];
                    $mapTempV[] = $this->value[$j];
                    break;
                }
            }
        }
        $this->kv = $mapTempK;
        $this->value = $mapTempV;
        return 1;
    }

    /**
     * public function descMap
     * @parameters none
     *
     */
    // Reverse order of Map
    public function descMap() {
        $mapTempK = array();
        $mapTempV = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1)
            return array($this->kv, $this->value);
        for ($j = $this->size()-1; $j >= 0; $j--) {
            $mapTempK[] = $this->kv[$j];
            $mapTempV[] = $this->value[$j];
        }
        $this->kv = $mapTempK;
        $this->value = $mapTempV;
        return 1;
    }

    /**
     * public function floorEntry
     * @parameters string
     *
     */
    // Get all Values >= $v
    public function floorEntry(string $v) {
        $vMap = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1)
            return array($this->kv[0], $this->value[0]);
        for ($i = 0; $i < $this->size(); $i++) {
            if (! ($v >= $this->value[$i])) {
                $vMap[] = $this->kv[$i-1];
                $vMap[] = $this->value[$i-1];
                return $vMap;
            }
        }
        return 0;
    }

    /**
     * public function navigableKeySet
     * @parameters string
     *
     */
    // Return all Keys
    public function navigableKeySet() {
        $mapTempK = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1)
            return array($this->kv[0]);
        for ($i = 0; $i < $this->size(); $i++) {
            $mapTempK[] = $this->kv[$i];
        }
        return $mapTempK;
    }

    /**
     * public function pollFirst
     * @parameters none
     *
     */
    // Get first entry in Map and remove
    public function pollFirst() {
        $mapTempK = array();
        $mapTempV = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1) {
            $j[0] = $this->kv[0];
            $j[1] = $this->value[1];
            $this->kv = null;
            $this->value = null;
            return $j;
        }
        for ($i = 1; $i < $this->size(); $i++) {
            $mapTempK[] = $this->kv[$i];
            $mapTempV[] = $this->value[$i];
            break;
        }
        if (sizeof($mapTempK) == 0) {
            $this->kv = null;
            $this->value = null;
            $this->setIndex(0);
            return 1;
        }
        $j[0] = $this->kv[0];
        $j[1] = $this->value[0];
        $this->kv = $mapTempK;
        $this->value = $mapTempV;
        $this->setIndex($this->getIndex());
        return $j;
    }

    /**
     * public function pollLast
     * @parameters none
     *
     */
    // Get last entry in Map and Remove
    public function pollLast() {
        $mapTempK = array();
        $mapTempV = array();
        ;
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        else if ($this->size() == 1) {
            $j[0] = $this->kv[0];
            $j[1] = $this->value[1];
            $this->kv = null;
            $this->value = null;
            return $j;
        }
        for ($i = 0; $i < $this->size(); $i++) {
            $mapTempK[] = $this->kv[$i];
            $mapTempV[] = $this->value[$i];
        }
        if (sizeof($tempAneous) == 0) {
            $this->kv = null;
            $this->value = null;
            $this->setIndex($this->getIndex());
            return 1;
        }
        $j[0] = $this->kv[$this->size()-1];
        $j[1] = $this->value[$this->size()-1];
        $this->kv = $mapTempK;
        $this->value = $mapTempV;
        $this->setIndex($this->getIndex());
        return $j;
    }
}

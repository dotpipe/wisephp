<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
    include("c:\\xampp\\htdocs\\adoms\\" . strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


class SortedMap extends Map {

    public $parentType;

    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Map';
        $this->typeOf = 'SortedMap';
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy() {
        $this->map = null;
    }

    /**
     * public function firstKey
     * @parameters none
     *
     */
    // Return first KV
    public function firstKey() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        return array($this->kv[0], $this->value[0]);
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
     * public function lastKey
     * @parameters none
     *
     */
    // Return last KV
    public function lastKey() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        return array($this->kv[$this->size()-1], $this->value[$this->size()-1]);
    }

    /**
     * public function loadJSON
     * @parameters string, int, int
     *
     */
    // Return Keys before $r
    // $vb == 2 returns all
    // $vb == 1 >= $v
    // $vb == 0 < $v
    public function headMap(string $v, int $vb, int $r) {
        $mapTempK = array();
        $mapTempV = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        for ($i = 0; $i < $r; $i++) {
            if ($v >= $this->value[$i] && $vb == 1) {
                $mapTempK[] = $this->kv[$i];
                $mapTempV[] = $this->value[$i];
            }
            else if ($v < $this->value[$i] && $vb == 0) {
                $mapTempK[] = $this->kv[$i];
                $mapTempV[] = $this->value[$i];
            }
            else if ($vb == 2) {
                $mapTempK[] = $this->kv[$i];
                $mapTempV[] = $this->value[$i];
            }
            else {
                throw new SyntaxError('Invalid Syntax');
                return 0;
            }
        }
        $vMap = new Map();
        $vMap->key = mapTempK;
        $vMap->value = mapTempV;
        return $vMap;
    }

    /**
     * public function subMap
     * @parameters string, int, string, int
     *
     */
    // Return KVs between $vst and $ven (This is very functional)
    // $Lb == 0 >= $vst ; $Lb == 1 < $vst
    // $Hb == 0 >= $ven ; $Hb == 1 < $ven
    public function subMap(string $vst, int $Lb, string $ven, int $Hb) {
        $mapTempK = array();
        $mapTempV = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        if ($vst > $ven) {
            $tmp = $ven;
            $ven = $vst;
            $vst = $tmp;
        }
        for ($i = 0; $i < $this->size(); $i++) {
            if ($Lb == 1) {
                if ($this->value[$i] >= $vst) {
                    do {
                        $mapTempK[] = $this->kv[$i];
                        $mapTempV[] = $this->value[$i];
                        $i++;
                    } while ($vst <= $this->value[$i]);
                }
            }
            else if ($Lb == 0) {
                if ($this->value[$i] > $vst) {
                    do {
                        $mapTempK[] = $this->kv[$i];
                        $mapTempV[] = $this->value[$i];
                        $i++;
                    } while ($vst <= $this->value[$i]);
                }
            }
            else if ($Hb == 1) {
                if ($this->value[$i] <= $ven) {
                    do {
                        $mapTempK[] = $this->kv[$i];
                        $mapTempV[] = $this->value[$i];
                        $i++;
                    } while ($ven >= $this->value[$i]);
                }
            }
            else if ($Hb == 0) {
                if ($this->value[$i] < $ven) {
                    do {
                        $mapTempK[] = $this->kv[$i];
                        $mapTempV[] = $this->value[$i];
                        $i++;
                    } while ($ven >= $this->value[$i]);
                }
            }
            else {
                throw new SyntaxError('Invalid Syntax');
                return 0;
            }
        }
        $vMap = new Map();
        $vMap->key = $mapTempK;
        $vMap->value = $mapTempV;
        return $vMap;
    }

    /**
     * public function loadJSON
     * @parameters string, int
     *
     */
    // Return Tail end of Map at $st
    public function tailMap(string $st, int $vb) {
        $mapTemp = array();
        $mapTempV = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return 0;
        }
        $vals = $this->value;
        sort($vals, SORT_STRING);
        for ($i = 0; $i < $this->size(); $i++) {
            if ($v >= $vals[$i] && $vb == 1) {
                $mapTempK[] = $this->kv[$i];
                $mapTempV[] = $this->value[$i];
            }
            else if ($v > $vals[$i] && $vb == 0) {
                $mapTempK[] = $this->kv[$i];
                $mapTempV[] = $this->value[$i];
            }
        }
        $vMap = new Map();
        $vMap->key = $mapTempK;
        $vMap->value = $mapTempV;
        return $vMap;
    }
}

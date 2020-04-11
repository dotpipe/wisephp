<?php declare (strict_types = 1);
namespace Adoms\src\lib;



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
        $this->pt = null;
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
            return false;
        }
        return array_keys($this->dat)[0];
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
     * public function lastKey
     * @parameters none
     *
     */
    // Return last KV
    public function lastKey() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        return array_keys($this->dat)[count($this->dat)];
    }

    /**
     * public function loadJSON
     * @parameters string, int, int
     *
     */
    // Return Keys before $r
    // $vb == 1 >= $v
    // $vb == 0 < $v
    public function headMap(string $v, bool $vb, int $r) {
        $mapTemp = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        foreach ($this->dat as $k => $v) {
            if ($st >= $v && $vb == 1) {
                $mapTemp = array_merge($mapTemp, array($k => $v));
            }
            else if ($st < $v && $vb == 0) {
                $mapTemp = array_merge($mapTemp, array($k => $v));
            }
            else {
                throw new SyntaxError('Invalid Syntax');
                return false;
            }
        }
        $vMap = new Map();
        foreach ($mapTemp as $k => $v)
            $vMap->add($k, $v);
        return $vMap;
    }

    /**
     * public function subMap
     * @parameters string, int, string, int
     *
     */
    // Return KVs between $vst and $ven (This is very functional)
    // $Lb == 0 : >= $vst ; $Lb == 1 : < $vst
    // $Hb == 0 : >= $ven ; $Hb == 1 : < $ven
    public function subMap(string $vst, bool $Lb, string $ven, bool $Hb) {
        $mapTemp = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        // let's go the right way thru
        if ($vst > $ven) {
            $tmp = $ven;
            $ven = $vst;
            $vst = $tmp;
        }
        if ($Lb == 1) {
            foreach ($this->dat as $k => $v) {
                if ($v >= $ven) {
                    $mapTemp = array_merge($mapTemp, array($k => $v));
                }
            }
        }
        else if ($Lb == 0) {
            foreach ($this->dat as $k => $v) {
                if ($v > $ven) {
                    $mapTemp = array_merge($mapTemp, array($k => $v));
                }
            }
        }
        if ($Hb == 1) {
            foreach ($this->dat as $k => $v) {
                if ($v <= $ven) {
                    $mapTemp = array_merge($mapTemp, array($k => $v));
                }
            }
        }
        else if ($Hb == 0) {
            foreach ($this->dat as $k => $v) {
                if ($v < $ven) {
                    $mapTemp = array_merge($mapTemp, array($k => $v));
                }
            }
        }
        else {
            throw new SyntaxError('Invalid Syntax');
            return false;
        }
        $vMap = new Map();
        foreach ($mapTemp as $k => $v)
            $vMap->add($k, $v);
        return $vMap;
    }

    /**
     * public function loadJSON
     * @parameters string, int
     *
     */
    // Return Tail end of Map at $st
    public function tailMap(int $st, bool $vb) {
        $mapTemp = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        foreach ($this->dat as $k => $v) {
            if ($st >= $v && $vb == 1) {
                $mapTemp = array_merge($mapTemp, array($k => $v));
            }
            else if ($st > $v && $vb == 0) {
                $mapTemp = array_merge($mapTemp, array($k => $v));
            }
        }
        $vMap = new Map();
        foreach ($mapTemp as $k => $v)
            $vMap->add($k, $v);
        return $vMap;
    }
}

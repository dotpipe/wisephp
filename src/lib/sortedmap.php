<?php declare (strict_types = 1);
namespace src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class SortedMap extends Map {

    public $parentType;

    /**
     * @method __construct
     * @param none
     * 
     * common init
     */
    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Map';
        $this->typeOf = 'SortedMap';
    }

    /**
     * @method destroy
     * @param none
     *
     */
    public function destroy() {
        $this->pt = null;
    }

    /**
     * @method firstKey
     * @param none
     *
     *
     * Return first KV
     */
    public function firstKey() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        return array_keys($this->dat)[0];
    }

    /**
     * @method save
     * @param string
     *
     */
    public function save(string $json_name): bool {
        $fp = fopen("$json_name", "w");
        fwrite($fp, serialize($this));
        fclose($fp);
        return true;
    }

    /**
     * @method loadJSON
     * @param string
     *
     */
    public function loadJSON(string $json_name): bool {
        if (file_exists("$json_name") && filesize("$json_name") > 0)
            $fp = fopen("$json_name", "r");
        else
            return false;
        $json_context = fread($fp, filesize("$json_name"));
        $old = unserialize($json_context);
        $b = $old;
        foreach ($b as $key => $val) {
            $this->$key = $b->$key;
        }
        return true;
    }

    /**
     * @method lastKey
     * @param none
     *
     *
     * Return last KV
     */
    public function lastKey() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        }
        return array_keys($this->dat)[count(array_keys($this->dat))-1];
    }

    /**
     * @method headMap
     * @param string, bool
     *
     *
     * Return Keys before $r
    // $vb == 1 >= $v
    // $vb == 0 < $v
     */
    public function headMap(string $v, bool $vb) {
        $mapTemp = array();
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Map');
            return false;
        } 
        {
            if ($vb == 1) {
                $mapTemp = array_splice($this->dat, $v, count($this->dat));
            }
            else if ($vb == 0) {
                $mapTemp = array_splice($this->dat, 0, $v);
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
     * @method subMap
     * @param string, int, string, int
     *
     *
     * Return KVs between $vst and $ven (This is very functional)
    // $Lb == 0 : >= $vst ; $Lb == 1 : < $vst
    // $Hb == 0 : >= $ven ; $Hb == 1 : < $ven
     */
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
     * @method loadJSON
     * @param string, int
     *
     *
     * Return Tail end of Map at $st
     */
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

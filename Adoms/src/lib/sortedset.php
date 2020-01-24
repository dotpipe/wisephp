<?php declare (strict_types = 1);
namespace Adoms\src\lib;


class SortedSet extends Set {

    public $sSetTemp;
    public $parentType;

    public function __construct() {
        $this->cache = array();
        $this->rootType = 'Container';
        $this->parentType = 'Set';
        $this->childType = 'Set';
        $this->typeOf = 'SortedSet';
        $this->dat = array();
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
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
     * public function headSet
     * @parameters int
     *
     */
    // Return entries before $indx
    public function headSet(int $indx) {
        if (!is_array($this->dat))
            $this->dat = [];
        $j = array_slice($this->dat, 0, $indx);
        return $j;
    }

    /**
     * public function first
     * @parameters none
     *
     */
    // Returns first Entry
    public function first() {
        if (!is_array($this->dat))
            $this->dat = [];
        $t = $this->dat;
        reset($t);
        return current($t);
    }

    /**
     * public function last
     * @parameters none
     *
     */
    // Returns last Entry
    public function last() {
        if (!is_array($this->dat))
            $this->dat = [];
        $t = $this->dat;
        end($t);
        return current($t);
    }

    /**
     * public function loadJSON
     * @parameters string, int, string, int
     *
     */
    // Return between $st and $en (This is very functional)
    // $Lb == 1 >= $st ; $Lb == 0 < $st
    // $Hb == 0 >= $en ; $Hb == < $en
    public function subSet(string $st, int $Lb, string $en, int $Hb) {
        $sSetTemp = '';
        if (!is_array($this->dat))
            $this->dat = [];
        for ($i = $st; $i < $this->size(); $i++) {
            if ($Lb == 1 && $this->dat[$i] >= $st) {
                do {
                    $sSetTemp[] = $this->dat[$i];
                    $i++;
                } while ($st <= $this->dat[$i] && $i < $this->size());
            }
            if ($Lb == 0 && $this->dat[$i] < $st) {
                do {
                    $sSetTemp[] = $this->dat[$i];
                    $i++;
                } while ($st < $this->dat[$i] && $i < $this->size());
            }
            if ($Hb == 1 && $this->dat[$i] <= $en) {
                do {
                    $sSetTemp[] = $this->dat[$i];
                    $i++;
                } while ($en <= $this->dat[$i] && $i < $this->size());
            }
            if ($Hb == 0 && $this->dat[$i] > $en) {
                do {
                    $sSetTemp[] = $this->dat[$i];
                    $i++;
                } while ($en < $this->dat[$i] && $i < $this->size());
            }
        }
        return $sSetTemp;
    }

}

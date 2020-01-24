<?php declare (strict_types = 1);
namespace Adoms\src\lib;



class NavigableSet extends SortedSet {

    public $navTemp;
    public $parentType;

    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Set';
        $this->childType = 'Set';
        $this->typeOf = 'NavigableSet';
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
     * public function ceiling
     * @parameters string
     *
     */
    // Retrieves first entry <= $r
    public function ceiling(string $r) {
        if (!is_array($this->dat))
            $this->dat = [];
        $t = $this->dat;
        rsort($t);
        $i = 0;
        reset($t);
        while ($i < count($t)) {
            if ($r >= current($t))
                break;
            next($t);
            $i++;
        }
        return current($t);
    }

    /**
     * public function floor
     * @parameters string
     *
     */
    // Retrieves first entry < $r
    public function floor(string $r) {
        if (!is_array($this->dat))
            $this->dat = [];
        $t = $this->dat;
        sort($t);
        $i = 0;
        reset($t);
        while ($i < count($t)) {
            if ($r > current($t))
                break;
            next($t);
            $i++;
        }
        return current($t);
    }

    /**
     * public function pollFirst
     * @parameters none
     *
     */
    // Retrieves and removes First Entry
    public function pollFirst() {
        if (!is_array($this->dat))
            $this->dat = [];
        $j = $this->dat[0];
        array_splice($this->dat, 0, 1);
        return $j;
    }

    /**
     * public function pollLast
     * @parameters none
     *
     */
    // Retrieves and erases last entry
    public function pollLast() {
        if (!is_array($this->dat))
            $this->dat = [];
        $j = $this->dat[count($this->dat)-1];
        array_splice($this->dat, -1);
        return $j;
    }

}

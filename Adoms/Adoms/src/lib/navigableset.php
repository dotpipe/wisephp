<?php
namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


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
        reset($this->dat);
        $j = current($this->dat);
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
        end($this->dat);
        $j = current($this->dat);
        array_splice($this->dat, -1);
        return $j;
    }

}

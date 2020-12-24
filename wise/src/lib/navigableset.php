<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class NavigableSet extends SortedSet {

    public $navTemp;
    public $parentType;

    /**
     * @method __construct
     * @param none
     * 
     * common init
     */
    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Set';
        $this->childType = 'Set';
        $this->typeOf = 'NavigableSet';
        $this->dat = array();
    }

    /**
     * @method destroy
     * @param none
     * @return void
     * 
     * destroy information
     */
    public function destroy() {
        $this->dat = null;
    }

    /**
     * @method ceiling
     * @param string
     *
     *
     * Retrieves first entry <= $r
     */
    public function ceiling(string $r) {
        $handler = $this->dat;
        $ceil = null;
        foreach ($handler as $k => $v) {
            if ($v >= $r && $ceil >= $v)
                $ceil = $v;
        }

        return array_search($ceil, $handler,true);
    }

    /**
     * @method floor
     * @param string
     *
     *
     * Retrieves first entry < $r
     */
    public function floor(string $r) {
        $handler = $this->dat;
        $floor = null;
        foreach ($handler as $k => $v) {
            if ($v <= $r && $floor <= $v)
                $floor = $v;
        }

        return array_search($floor, $handler,true);
    }

    /**
     * @method pollFirst
     * @param none
     *
     *
     * Retrieves and removes First Entry
     */
    public function pollFirst() {
        if (!is_array($this->dat))
            $this->dat = [];
        reset($this->dat);
        $j = current($this->dat);
        array_shift($this->dat);
        return $j;
    }

    /**
     * @method pollLast
     * @param none
     *
     *
     * Retrieves and erases last entry
     */
    public function pollLast() {
        if (!is_array($this->dat))
            $this->dat = [];
        $j = end($this->dat);
        array_pop($this->dat);
        return $j;
    }

}

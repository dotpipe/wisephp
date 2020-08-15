<?php declare (strict_types = 1);
namespace Adoms\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

class Queue extends Common {

    public $queueTemp;
    public $parentType;

    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Queue';
        $this->childType = 'Queue';
        $this->typeOf = 'Queue';
    }

    public function destroy() {
        $this->dat = null;
    }

    /**
     * public function poll
     * @parameters none
     *
     */
    // Remove while Retrieving entry 1
    public function poll() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Queue');
            return false;
        }
        $j = $this->dat[0];
        array_shift($this->dat);
        $this->setIndex($this->getIndex());
        return $j;
    }

    /**
     * public function push
     * @parameters mixed
     *
     */
    // Push on to Queue
    public function push($r) {
        return array_push($this->dat, $r);
    }

    /**
     * public function pop
     * @parameters none
     *
     */
    // Retrieve first Queue and pop
    public function pop() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Queue');
            return false;
        }
        array_pop($this->dat);
        return true;
    }

    /**
     * public function getElement
     * @parameters none
     *
     */
    // Return first Queue
    public function getElement() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Queue');
            return false;
        }
        return $this->dat[0];
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    // Empty Queue
    public function clear() {
        $this->dat = array();
        return true;
    }
}

<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

class Queue extends Common {

    public $queueTemp;
    public $parentType;

    /**
     * @method __construct
     * @param none
     * @return void
     * 
     * common init
     */
    public function __construct() {
        $this->rootType = 'Container';
        $this->parentType = 'Queue';
        $this->childType = 'Queue';
        $this->typeOf = 'Queue';
    }

    /**
     * @method destroy
     * @param none
     * 
     * destroy information
     */
    public function destroy() {
        $this->dat = null;
    }

    /**
     * @method poll
     * @param none
     *
     *
     * Remove while Retrieving entry 1
     */
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
     * @method push
     * @param mixed
     *
     *
     * Push on to Queue
     */
    public function push($r) {
        return array_push($this->dat, $r);
    }

    /**
     * @method pop
     * @param none
     *
     *
     * Retrieve first Queue and pop
     */
    public function pop() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Queue');
            return false;
        }
        array_pop($this->dat);
        return true;
    }

    /**
     * @method getElement
     * @param none
     *
     *
     * Return first Queue
     */
    public function getElement() {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Queue');
            return false;
        }
        return $this->dat[0];
    }

    /**
     * @method clear
     * @param none
     *
     *
     * Empty Queue
     */
    public function clear() {
        $this->dat = array();
        return true;
    }
}

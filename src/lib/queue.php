<?php declare (strict_types = 1);
namespace Adoms\src\lib;



class Queue {

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
     * public function size
     * @parameters none
     *
     */
    // Report Size of Container
    public function size() {
        if (sizeof($this->dat) >= 0)
            return sizeof($this->dat);
        else return -1;
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
        $this->dat = $queueTemp;
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

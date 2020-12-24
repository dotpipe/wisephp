<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class Stack {

    // Wait in milliseconds for wait()
    public $calipers;
    // Queue of threads (was $FIFO)
    public $stack;
    // Max amount of Queued threads
    public $ADDRS_STK_CNT;
    public $parentType;

    /**
     * @method __construct
     * @param none
     * 
     * common init
     */
    public function __construct() {
        $this->rootType = 'DataLayer';
        $this->parentType = 'Thread';
        $this->typeOf = 'Stack';
        $this->ADDRESS_STACK_COUNT = 10;
        $this->calipers = 30000;
        $this->stack = new Queue();
    }

    /**
     * @method save
     * @param string
     *
     */
    public function save(string $json_name) {
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
     * @method size
     * @param none
     *
     *
     * Report size of stack
     */
    public function size() {
        if (sizeof($this->stack) >= 0)
            return sizeof($this->stack);
        else return -1;
    }

    /**
     * @method unstack
     * @param none
     *
     *
     * Add all elements of Stack to page
     */
    public function unstack() {
        //tell each session ID to update..
        while ($this->size() > 0) {
            include_once($this->stack->poll());
        }
    }

    /**
     * @method threadManager
     * @param none
     *
     *
     * ADDRS_STK_CNT is a variable of MAX Stack height
    // When surpassed, it calls unstack (careful to not set too high)
     */
    public function threadManager() {
        if ($this->size() > $this->ADDRESS_STACK_COUNT)
            $this->unstack();
    }

    /**
     * @method insert
     * @param string
     *
     *
     * Add stack URL
     */
    public function insert(string $stackurl) {
        array_push($this->stack, $stackurl);
    }

    /**
     * @method clear
     * @param none
     *
     *
     * Empty Stack
     */
    public function clear() {
        $this->stack = array();
    }
}

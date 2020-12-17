<?php declare (strict_types = 1);
namespace wise\src\lib;


require_once __DIR__ . '../../../../vendor/autoload.php';

class Thread extends Streams {
    // *************
    // BEGIN HERE
    // start new thread for Javascript
    // interactions. Pass JSONs dynamically.
    // If a Value changes, it can be reassigned.
    // Setup new Stack(), insert threads
    // and you can have unlimited constructs,
    // like the ones here, in SCHOOL handling
    // the data most civil to break up long and
    // boring but effective ways to act. A running
    // SESSID process, detached.
    // To join it, read from and write to the
    // the file for which it is attached to.
    // Just make sure it is included in the file,
    // and keep this to the core of the dynamics.
    // startThread($filename) to join, do some
    // JSON stuff to it or delimited information.
    // It's ALL GOOOD!!! Have pages refresh every
    // couple minutes or just when the user commands it.
    // To enable simultaneous function:
    // after Interval({}), open md5(user).JSON file
    // and read Array. Dynamically exchange
    // between servers and pages. Keep all
    // code secret by using a rwStream() read to
    // make server updates that fit user needs.
    // Frequency means data congruency
    // between users and admins by JSON.
    // This just personalizes the task.
    // Direct and redirect thru "/ini/" files
    // *************
    public $parentType;
    // Thread pointer
    public $finit;
    // Current local Directory
    public $dir;

    public function __construct() {
        $this->rootType = 'DataLayer';
        $this->parentType = 'DataLayer';
        $this->typeOf = 'Thread';
        $this->dir = "ini/";
        $this->seqCntr = 0;
    }

    /**
     * public function size
     * @parameters string
     *
     */
    public function size(): int {
        return count($this->size());
    }

    /**
     * public function startThread
     * @parameters string
     *
     */
    // $origin mut be Unique to each user.
    // This creates a database of CSV files
    // Each is seemingly randomly named.
    // (Hold sequential $handles in $origin files)
    // Use JSON if CSV is not to your liking.
    public function startThread(string $origin) {
        $handle = md5($origin);
        if ($this->touch($this->dir . $handle) == 1)
            $this->add($this->dir . $handle, 1);
        else
            return false;
        $this->Iter();
        return true;
    }

    /**
     * public function save
     * @parameters string
     *
     */
    public function save(string $json_name): bool {
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
    public function loadJSON(string $json_name): bool {
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
     * public function joinThread
     * @parameters none
     *
     */
    // Like all joins
    public function join() {
        return $this->sync();
    }

    /**
     * public function setIndex
     * @parameters int
     *
     */
    // Set Index
    public function setIndex(int $index) {
        return $this->setIndex($index);
    }

    /**
     * public function getIndex
     * @parameters none
     *
     */
    // Current thread
    public function getIndex(): int {
        return parent::getIndex();
    }

    /**
     * public function current
     * @parameters none
     *
     */
    // Current Thread
    public function current(): int {
        return parent::current();
    }

    /**
     * public function nextThread
     * @parameters none
     *
     */
    // Forward Iteration
    public function next() {
        return $this->next();
    }

    /**
     * public function prevThread
     * @parameters none
     *
     */
    // Previous Iteration
    public function prev(): bool {
        return parent::prev();
    }

    /**
     * public function Iter
     * @parameters none
     *
     */
    // Forward Iterator
    public function Iter(): bool {
        return $this->Iter();
    }

    /**
     * public function Cycle
     * @parameters none
     *
     */
    // Forward Cycle Iterator
    public function Cycle(): bool {
        if ($this->size() == $this->getIndex()+1) {
            $this->setIndex(0);
            $this->join();
            return false;
        }
        return $this->Iter();
    }

    /**
     * public function revIter
     * @parameters none
     *
     */
    // Reverse Iterator
    public function revIter(): bool {
        return $this->revIter();
    }

    /**
     * public function revCycle
     * @parameters none
     *
     */
    // Reverse Cycle Iterator
    public function revCycle(): bool {
        if (-1 == $this->getIndex()-1) {
            $this->setIndex($this->size()-1);
            $this->join();
            return false;
        }
        return $this->Iter();
    }

    /**
     * public function clearThread
     * @parameters string
     *
     */
    // Empty Thread file
    public function clearThread(string $origin) {
        $handle = md5($origin);
        if (file_exists($this->dir . $handle) == 1) {
            fopen($this->dir . $handle, 'w');
            if (filesize($this->dir . $handle) == 0)
                return true;
            else
                return false;
        }
        else
            return false;
        return true;
    }

    /**
     * public function endThread
     * @parameters none
     *
     */
    // Detach Thread (Its a file, its not going anywhere *hint, hint* other languages)
    public function endThread() {
        parent::removeIndex($this->getIndex());
        $this->Iter();
        $this->seqStrms->setIndex($this->getIndex());
        return true;
    }

    /**
     * public function readThread
     * @parameters none
     *
     */
    // Read from Thread file
    public function readThread() {
        $this->setDelim("}");
        $this->resize(0);
        while (! $this->eof()) {
            $this->readBuf();
            array($this->json, $this->buffData);
            $this->buffData = null;
        }
        return true;
    }

    /**
     * public function writeThread
     * @parameters mixed
     *
     */
    // Write to Thread file
    public function writeThread($obj_array) {
        $x = json_encode($obj_array);
        if ($this->stream == null || $this->streamName == null)
            return false;
        fwrite($this->stream, $x);
        return true;
    }
}

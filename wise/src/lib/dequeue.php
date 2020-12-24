<?php declare (strict_types = 1);
namespace wise\src\lib;


require_once __DIR__ . '../../../../vendor/autoload.php';
class Dequeue extends Common
{
    public $dqueueTemp;
    public $parentType;

    /**
     * @method __construct
     * @param none
     * 
     * common init
     */
    public function __construct()
    {
        $this->rootType = 'Container';
        $this->parentType = 'Dequeue';
        $this->childType = 'Dequeue';
        $this->typeOf = 'Dequeue';
    }

    /**
     * @method destroy
     * @param none
     * @return void
     * 
     * destroy information
     */
    public function destroy()
    {
        $this->dat = null;
    }
    
    /**
     * @method size
     * @param none
     * @return int
     * 
     * Report Size of Container
     */
    public function size(): int
    {
        if (count($this->dat) >= 0)
            return count($this->dat);
        else return false;
    }
    
    /**
     * @method pollFront
     * @param none
     * @return string
     * 
     * Return front, and pop it off
     */
    public function pollFront(): string
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Dequeue');
            return false;
        }
        $hold = array_shift($this->dat);
        return $hold;
    }

    
    /**
     * @method pollBack
     * @param none
     * @return string
     * 
     * Return back, and pop it off
     */
    public function pollBack(): string
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Dequeue');
            return false;
        }
        $hold = array_pop($this->dat);
        return $hold;
    }

    
    /**
     * @method push
     * @param none
     * @return int
     * 
     * Push object onto end
     */
    public function push($r): int
    {
        return array_push($this->dat, $r);
    }

    /**
     * @method poo
     * @param none
     * @return bool
     * 
     * Remove last entry
     */
    public function pop(): bool
    {
        array_pop($this->dat);
        return true;
    }

    /**
     * @method getFirst
     * @param none
     * @return mixed
     * 
     * Retrieve First Entry
     */
    public function getFirst()
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        return $this->dat[0];
    }

    /**
     * @method getLast
     * @param none
     * @return int
     * 
     * Retrieve last entry
     */
    public function getLast()
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        return $this->dat[array_key_last($this->dat)];
    }

    /**
     * @method clear
     * @param none
     * @return bool
     * 
     * Empty Dequeue
     */
    public function clear(): bool
    {
        $this->dat = array();
        return true;
    }

    /**
     * @method removeFirst
     * @param none
     * @return bool
     * 
     * Remove First Entry
     */
    public function removeFirst(): bool
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        array_shift($this->dat);
        return true;
    }

    /**
     * @method size
     * @param none
     * @return int
     * 
     * Remove first occurrence of $r
     */
    public function remFirstOcc($r): bool
    {
        $dequeueTemp = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        $p = 0;
        $r = array_search($r, $this->dat, false);
        unset($this->dat[$r]);
        return true;
    }

    /**
     * @method remLastOcc
     * @param none
     * @return int
     * 
     * Remove last occurrence of $r
     */
    public function remLastOcc($r): bool
    {
        $dqueueTemp = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        $m = $this->size();
        array_reverse($this->dat);
        $t = array_search($r, $this->dat,false);
        unset($this->dat[$t]);
        array_reverse($this->dat);
        $this->setIndex($this->getIndex());
        return true;
    }
}

<?php
namespace Adoms\src\lib;

spl_autoload_register(function ($className) {
    if ($className === "Classes") {
        return;
    }
    foreach ([
        'Adoms/src/lib/',
        ''
    ] as $Path) {
        if (!file_exists($Path . $className . '.php')) {
            continue;
        }
        include $Path . $className . '.php';
    }
});

class Dequeue
{
    public $dqueueTemp;
    public $parentType;

    public function __construct()
    {
        $this->rootType = 'Container';
        $this->parentType = 'Dequeue';
        $this->childType = 'Dequeue';
        $this->typeOf = 'Dequeue';
    }

    public function destroy()
    {
        $this->dat = null;
    }

    // Report Size of Container
    public function size(): int
    {
        if (count($this->dat) >= 0)
            return count($this->dat);
        else return 0;
    }

    // Retrieve and Remove first Entry
    public function pollFront(): string
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Dequeue');
            return 0;
        }
        $hold = array_shift($this->dat);
        return $hold;
    }

    // Retrieve and Remove last entry
    public function pollBack(): string
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) throw new IndexException('Empty Dequeue');
            return 0;
        }
        $hold = $this->dat->pop();
        return $hold;
    }

    // Add entry
    public function push($r)
    {
        return $this->dat[] = $r;
    }

    // Remove last entry
    public function pop(): bool
    {
        array_pop($this->dat);
        return 1;
    }

    // Retrieve First Entry
    public function getFirst()
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return 0;
        }
        return $this->dat[0];
    }

    // Retrieve Last Entry
    public function getLast()
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return 0;
        }
        return $this->dat[$this->size()-1];
    }

    // Empty Dequeue
    public function clear(): bool
    {
        $this->dat = array();
        return 1;
    }

    // Remove first entry
    public function removeFirst(): bool
    {
        $dqueueTemp = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return 0;
        }
        array_shift($this->dat);
        return 1;
    }

    // Remove first occurrence of $r
    public function remFirstOcc($r): bool
    {
        $dequeueTemp = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return 0;
        }
        $p = 0;
        $r = array_search($r, $this->dat, false);
        unset($this->dat[$r]);
        $this->dat = $dequeueTemp;
        return 1;
    }

    // Remove Last occurrence of $r
    public function remLastOcc($r): bool
    {
        $dqueueTemp = '';
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return 0;
        }
        $m = $this->size();
        array_reverse($this->dat);
        $t = array_search($r, $this->dat,false);
        unset($this->dat[$t]);
        array_reverse($this->dat);
        $this->setIndex($this->getIndex());
        return 1;
    }
}

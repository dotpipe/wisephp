<?php declare(strict_types = 1);
namespace Adoms\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';
class Dequeue extends Common
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
        if (count($this->dat) >= 0) {
            return count($this->dat);
        } else {
            return false;
        }
    }

    // Retrieve and Remove first Entry
    public function pollFront(): string
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        $hold = array_shift($this->dat);
        return $hold;
    }

    // Retrieve and Remove last entry
    public function pollBack(): string
    {
        if ($this->size() == 0) {
            if ($this->strict == 1) {
                throw new IndexException('Empty Dequeue');
            }
            return false;
        }
        $hold = array_pop($this->dat);
        return $hold;
    }

    // Add entry
    public function push($r): int
    {
        return array_push($this->dat, $r);
    }

    // Remove last entry
    public function pop(): bool
    {
        array_pop($this->dat);
        return true;
    }

    // Retrieve First Entry
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

    // Retrieve Last Entry
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

    // Empty Dequeue
    public function clear(): bool
    {
        $this->dat = array();
        return true;
    }

    // Remove first entry
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

    // Remove first occurrence of $r
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

    // Remove Last occurrence of $r
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
        $t = array_search($r, $this->dat, false);
        unset($this->dat[$t]);
        array_reverse($this->dat);
        $this->setIndex($this->getIndex());
        return true;
    }
}

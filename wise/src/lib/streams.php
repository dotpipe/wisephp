<?php
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

class Streams extends Map {

    public $rootType;
    public $parentType;
    public $typeOf;
    // File name
    public $name;
    // Stream pointer
    public $strm;
    public $strmkey;
    // $stream array()
    public $dat;
    // Index of $dat
    public $datCntr;
    // Buffer of Read data
    public $buffData;
    // Read $buffSize amount of data
    public $buffSize;
    // Temporary buffer
    public $buf;
    // Stop at $delim if before $buffSize OR $buffsize == 0
    public $delim;
    public $dir;

    public function __construct() {
        $this->dat = [];
        $this->datCntr = 0;
        $this->dir = "./";
    }

    /**
     * @method destroy
     * @param none
     *
     */
    public function destroy() {
        $this->dat = new Map();
    }

    /**
     * @method getIndex
     * @param none
     *
     *
     * Retrieve Index
     */
    public function getIndex(): int {
        return $this->datCntr;
    }

    /**
     * @method erase
     * @param string
     *
     *
     * Erase file
     */
    public function erase(string $filename): bool {
        if (file_exists($filename)) {
            $this->delete($filename);
            touch($filename);
            return 1;
        }
        return 0;
    }

    /**
     * @method delete
     * @param string
     *
     *
     * Delete file
     */
    public function delete(string $filename): bool {
        if (file_exists($filename)) {
            unlink($filename);
            fclose($this->dat[$filename]);
            return 1;
        }
        return 0;
    }

    /**
     * @method touch
     * @param string
     *
     *
     * Create new File Or check if exists
     */
    public function touch(string $filename): bool {
        \file_put_contents($filename, "");
        if (file_exists($filename)) {
            return true;
        }
        return false;
    }


    /**
     * @method addStrm
     * @param string
     *
     *
     * Add to Stream array()
     */
    public function addStrm(string $r, bool $bool = FALSE): bool {
        $rw = '';
        if ($this->typeOf == 'readStream')
            $rw = 'r';
        else if ($this->typeOf == 'rwStream')
            $rw = 'a';
        else $rw = 'w';
        if ($bool == 1)
            $rw .= '+';
        if (!\file_exists("$this->dir/$r"))
            $this->touch("$this->dir/$r");
        $ed = fopen("$this->dir/$r", $rw);
        $this->add("$this->dir/$r",$ed);
        $this->sync();
        return 1;
    }

    /**
     * @method size
     * @param string
     *
     *
     * Report how many streams in Object
     */
    public function size(): int {
        return count($this->dat);
    }

    /**
     * @method Iter
     * @param none
     *
     *
     * Iterate Forward through Streams
     */
    public function Iter(): bool {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->dat)) {
            if (!empty($this->dat) != null && current($this->dat) != null)
                $this->add(key($this->dat), current($this->dat));
            $this->datCntr++;
            next($this->dat);
            $this->sync();
        }
        else
            return 0;
        return 1;

    }

    /**
     * @method Cycle
     * @param none
     *
     *
     * Cycle Forward through Vector
     */
    public function Cycle(): bool {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->dat)) {
            if (key($this->dat) != null && current($this->dat) != null)
                $this->add(key($this->dat), current($this->dat));
            $this->datCntr++;
            next($this->dat);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * @method revIter
     * @param none
     *
     *
     * Iterate Forward through Streams
     */
    public function revIter(): bool {
        if ($this->datCntr > 0 && $this->datCntr < count($this->dat)) {
            if (key($this->dat) != null && current($this->dat) != null)
                $this->add(key($this->dat), current($this->dat));
            $this->datCntr--;
            prev($this->dat);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * @method revCycle
     * @param none
     *
     */
    public function revCycle(): bool {
        if ($this->datCntr > 0 && $this->datCntr < count($this->dat)) {
            if (key($this->dat) != null && current($this->dat) != null)
                $this->add(key($this->dat), current($this->dat));
            $this->datCntr--;
            prev($this->dat);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * @method prevStrm
     * @param none
     *
     *
     * Iterate to Previous Streams if $bool = 1;
    // Setup $cntDecr (index) for Prev. Streams if $bool = 0;
     */
    public function prev(): bool {
        if ($this->datCntr > 0 && $this->datCntr < count($this->dat)) {
            if (key($this->dat) != null && current($this->dat) != null)
                $this->add(key($this->dat), current($this->dat));
            $this->datCntr--;
            prev($this->dat);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * @method currStrm
     * @param none
     *
     *
     * Retrieve current Index of Vector Pointer
     */
    public function current(): int {
        return $this->getIndex();
    }


    /**
     * @method remove
     * @param string
     *
     *
     * Remove Stream at index $r
     */
    public function removeIndex(int $r): bool {
        if (!is_array($this->dat)) {
            $this->dat = [];
            return 0;
        }
        $j = array_splice($this->dat, $r, 1);
        return 1;
    }

    /**
     * @method fileSize
     * @param none
     *
     *
     * Get FileSize
     */
    public function fileSize(): int {
        return filesize(key($this->dat));
    }

    /**
     * @method sync
     * @param none
     *
     */
    public function sync(): bool {
        $keys = array_keys($this->dat);

        $t = $this->dat[$keys[$this->datCntr]];
        $k = $keys[$this->datCntr];

        $this->strm = $t;
        $this->strmkey = $k;
        return 1;
    }

    /**
     * @method resize
     * @param int
     *
     *
     * Resize reading Buffer
     */
    public function resize(int $s): bool {
        if ($s > 0)
            $this->buffSize = $s;
        else
            return 0;
        return 1;
    }

    /**
     * @method setDelim
     * @param string
     *
     *
     * Set Delimiter
     */
    public function setDelim(string $d): bool {
        $d = $d[0];
        return $this->delim = $d;
    }

    /**
     * @method resetDelimm
     * @param none
     *
     *
     * Eliminate Delimiter
     */
    public function resetDelim(): bool {
        return $this->delim = '';
    }

    /**
     * @method clearBuf
     * @param none
     *
     *
     * Empty Buffer
     */
    public function clearBuf() {
        return $this->buffData = null;
    }

    /**
     * @method seek
     * @param int, int
     *
     *
     * Seek to point in file
     */
    public function seek(int $pos, int $flag): bool {
        $f = '';
        if ($flag == 'e')
            $f = 'SEEK_END';
        else if ($flag == 's')
            $f = 'SEEK_SET';
        else if ($flag == 'c')
            $f = 'SEEK_CUR';
        else if ($flag == 'SEEK_END' || $flag == 'SEEK_SET' || $flag == 'SEEK_CUR')
            $f = $f;
        else
            return 0;
        if (current($this->dat) == null || key($this->dat) == null) {
            throw new IndexException('Stream is null');
            return 0;
        }
        else
            fseek(current($this->dat), $pos, $f);
        return 1;
    }

    /**
     * @method eof
     * @param none
     *
     *
     * Check for End of File
     */
    public function eof(): bool {
        if (feof(current($this->dat)) || key($this->dat) == null)
            return 0;
        else
            return 1;
    }

    /**
     * @method readBuf
     * @param none
     *
     *
     * Read from File
     */
    public function readBuf(): string {
        if ($this->parentType != 'Streams' && ($this->typeOf != 'rwStream' || $this->typeOf != 'readStream')) {
            throw new IndexException('Not a valid Stream');
            return "Error: No stream";
        }
        if ($this->size() == 0) {
            throw new IndexException('Empty Stream Array');
            return "Error: No stream";
        }
        if (!file_exists(key($this->dat)))
            return "Error: No stream";
        if ($this->buffSize == 0) {
            $path = key($this->dat);
            $this->buffData = file_get_contents($path);
            return $this->buffData;
        }
        else
            $y = $this->buffSize;

        for ($i = 0; $i < $y; $i++) {
            $buf = fgetc(current($this->dat));
            if ($buf == '<')
                $buf = '&lt;';
            if ($buf == $this->delim || feof(current($this->dat)))
                break;
            $this->buffData .= $buf;
        }
        return $this->buffData;
    }

    /**
     * @method writeBuf
     * @param none
     *
     *
     * Write to Buffer File
     */
    public function writeBuf(): int {
        if (current($this->dat) != null && $this->typeOf != "readStream")
            return fwrite(current($this->dat), $this->buf);
        return 0;
    }

    /**
     * @method close
     * @param none
     *
     *
     * Close File
     */
    public function close(): bool {
        $o = array_search(current($this->dat),$this->dat);
        unset($this->dat[$o]);
        $this->setIndex($this->getIndex());
        return 1;
    }

    /**
     * @method changeDir
     * @param string
     *
     *
     * Change local directory
     */
    public function changeDir(string $directory): string {
        $this->dir = $directory;
        return $this->dir;
    }
}

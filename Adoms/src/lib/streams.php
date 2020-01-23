<?php //declare (strict_types = 1);
namespace Adoms\src\lib;
//

class Streams extends Map implements Classes {

    public $rootType;
    public $parentType;
    public $typeOf;
    // File name
    public $name;
    // Stream pointer
    public $strm;
    public $strmkey;
    // $stream array()
    public $dat = array();
    // Index of $dat
    public $datCntr;
    // Buffer of Read data
    public $buffData;
    // Read $buffSize amount of data
    public $buffSize;
    // Temporary buffer
    public $buf;
    // Stop at $delim if before $buffSize OR $buffsize == 0
    private $delim;

    public function __construct() {
        $this->dat = new Map();
        $this->datCntr = 0;
        reset($this->kv);
        $this->dir = "";
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy() {
        $this->kv = new Map();
    }

    /**
     * public function getIndex
     * @parameters none
     *
     */
    // Retrieve Index
    public function getIndex(): int {
        return $this->datCntr;
    }

    /**
     * public function erase
     * @parameters string
     *
     */
    // Erase file
    public function erase(string $filename): bool {
        if (file_exists($filename)) {
            $this->delete($filename);
            touch($filename);
            return 1;
        }
        return 0;
    }

    /**
     * public function delete
     * @parameters string
     *
     */
    // Delete file
    public function delete(string $filename): bool {
        if (file_exists($filename)) {
            unlink($filename);
            fclose($this->kv[$filename]);
            return 1;
        }
        return 0;
    }

    /**
     * public function touch
     * @parameters string
     *
     */
    // Create new File Or check if exists
    public function touch(string $filename): bool {
        $dir = \explode("/", $filename);
        $i = 0;
        $dir_structs = "";
        while ($i < sizeof($dir)-1  && 10 > sizeof($dir)) {
            if (!is_dir($dir_structs . "/" . $dir[$i]))
                \mkdir($dir_structs . "/" . $dir[$i]);
            if (!is_dir($dir_structs . "/" . $dir[$i]))
                return 0;
            $dir_structs .= "/" . $dir[$i];
            $i++;
        }
        if (file_exists($dir_structs . "/" . $dir[sizeof($dir)-1]))
            return 1;
        if (file_exists($dir_structs . "/" . $dir[sizeof($dir)-1])) {
            return 1;
        }
        return 0;
    }

    /**
     * public function addStrm
     * @parameters string
     *
     */
    // Add to Stream array()
    public function addStrm(string $r, bool $bool = FALSE): bool {
        $rw = '';
        if ($this->typeOf == 'readStream')
            $rw = 'r';
        else if ($this->typeOf == 'rwStream')
            $rw = 'a';
        else $rw = 'w';
        if ($bool == 1)
            $rw .= '+';
        $ed = fopen("$this->dir/$r", $rw);
        $this->add("$this->dir/$r",$ed);
        $this->sync();
        return 1;
    }

    /**
     * public function size
     * @parameters string
     *
     */
    // Report how many streams in Object
    public function size(): int {
        return count($this->kv);
    }

    /**
     * public function Iter
     * @parameters none
     *
     */
    // Iterate Forward through Streams
    public function Iter(): bool {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->kv)) {
            if (key($this->kv) != null && current($this->kv) != null)
                $this->add(key($this->kv), current($this->kv));
            $this->datCntr++;
            next($this->kv);
            $this->sync();
        }
        else
            return 0;
        return 1;

    }

    /**
     * public function Cycle
     * @parameters none
     *
     */
    // Cycle Forward through Vector
    public function Cycle(): bool {
        if ($this->datCntr >= 0 && $this->datCntr + 1 < count($this->kv)) {
            if (key($this->kv) != null && current($this->kv) != null)
                $this->add(key($this->kv), current($this->kv));
            $this->datCntr++;
            next($this->kv);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * public function revIter
     * @parameters none
     *
     */
    // Iterate Forward through Streams
    public function revIter(): bool {
        if ($this->datCntr > 0 && $this->datCntr < count($this->kv)) {
            if (key($this->kv) != null && current($this->kv) != null)
                $this->add(key($this->kv), current($this->kv));
            $this->datCntr--;
            prev($this->kv);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * public function revCycle
     * @parameters none
     *
     */
    public function revCycle(): bool {
        if ($this->datCntr > 0 && $this->datCntr < count($this->kv)) {
            if (key($this->kv) != null && current($this->kv) != null)
                $this->add(key($this->kv), current($this->kv));
            $this->datCntr--;
            prev($this->kv);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * public function prevStrm
     * @parameters none
     *
     */
    // Iterate to Previous Streams if $bool = 1;
    // Setup $cntDecr (index) for Prev. Streams if $bool = 0;
    public function prev(): bool {
        if ($this->datCntr > 0 && $this->datCntr < count($this->kv)) {
            if (key($this->kv) != null && current($this->kv) != null)
                $this->add(key($this->kv), current($this->kv));
            $this->datCntr--;
            prev($this->kv);
            $this->sync();
        }
        else
            return 0;
        return 1;
    }

    /**
     * public function currStrm
     * @parameters none
     *
     */
    // Retrieve current Index of Vector Pointer
    public function current(): int {
        return $this->getIndex();
    }


    /**
     * public function remove
     * @parameters string
     *
     */
    // Remove Stream at index $r
    public function removeIndex(int $r): bool {
        if (!is_array($this->kv)) {
            $this->dat = [];
            return 0;
        }
        $j = array_splice($this->dat, $r, 1);
        return 1;
    }

    /**
     * public function fileSize
     * @parameters none
     *
     */
    // Get FileSize
    public function fileSize(): int {
        return filesize(key($this->kv));
    }

    /**
     * public function sync
     * @parameters none
     *
     */
    public function sync(): bool {
        $keys = array_keys($this->kv);

        $t = $this->kv[$keys[$this->datCntr]];
        $k = $keys[$this->datCntr];

        $this->strm = $t;
        $this->strmkey = $k;
        return 1;
    }

    /**
     * public function resize
     * @parameters int
     *
     */
    // Resize reading Buffer
    public function resize(int $s): bool {
        if ($s > 0)
            $this->buffSize = $s;
        else
            return 0;
        return 1;
    }

    /**
     * public function setDelim
     * @parameters string
     *
     */
    // Set Delimiter
    public function setDelim(string $d): bool {
        $d = $d[0];
        return $this->delim = $d;
    }

    /**
     * public function resetDelimm
     * @parameters none
     *
     */
    // Eliminate Delimiter
    public function resetDelim(): bool {
        return $this->delim = '';
    }

    /**
     * public function clearBuf
     * @parameters none
     *
     */
    // Empty Buffer
    public function clearBuf(): bool {
        return $this->buffData = null;
    }

    /**
     * public function seek
     * @parameters int, int
     *
     */
    // Seek to point in file
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
        if (current($this->kv) == null || key($this->kv) == null) {
            throw new IndexException('Stream is null');
            return 0;
        }
        else
            fseek(current($this->kv), $pos, $f);
        return 1;
    }

    /**
     * public function eof
     * @parameters none
     *
     */
    // Check for End of File
    public function eof(): bool {
        if (feof(current($this->kv)) || key($this->kv) == null)
            return 0;
        else
            return 1;
    }

    /**
     * public function readBuf
     * @parameters none
     *
     */
    // Read from File
    public function readBuf(): bool {
        if ($this->parentType != 'Streams' && ($this->typeOf != 'rwStream' || $this->typeOf != 'readStream')) {
            throw new IndexException('Not a valid Stream');
            return 0;
        }
        if ($this->size() == 0) {
            throw new IndexException('Empty Stream Array');
            return 0;
        }
        if (!file_exists(key($this->kv)))
            return 0;
        if ($this->buffSize == 0) {
            $path =  $this->strmkey;
            $this->buffData = file_get_contents($path);
            return 1;
        }
        else
            $y = $this->buffSize;

        for ($i = 0; $i < $y; $i++) {
            $buf = fgetc($this->strm);
            if ($buf == '<')
                $buf = '&lt;';
            if ($buf == $this->delim || feof($this->strm))
                break;
            $this->buffData .= $buf;
        }
        return 1;
    }

    /**
     * public function writeBuf
     * @parameters none
     *
     */
    // Write to Buffer File
    public function writeBuf(): int {
        if ($this->strm != null && $this->typeOf != "readStream")
            return fwrite($this->strm, $this->buf);
        else
            return 0;
    }

    /**
     * public function close
     * @parameters none
     *
     */
    // Close File
    public function close(): bool {
        fclose(current($this->kv));
        $this->remSeqStrm($this->getIndex());
        $this->setIndex($this->getIndex());
        return 1;
    }

    /**
     * public function changeDir
     * @parameters string
     *
     */
    // Change local directory
    public function changeDir(string $directory): string {
        $this->dir = $directory;
        return $this->dir;
    }
}

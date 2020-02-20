<?php
namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

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
    // CWD
    public $dir;

    public function __construct() {
        $this->dat = new Map();
        $this->datCntr = 0;
        $this->parentType = "Streams";
        $this->rootType = "Maps";
        reset($this->dat);
        $this->dir = ".";
    }

    /**
     * public function destroy
     * @parameters none
     *
     */
    public function destroy() {
        $this->dat = new Map();
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
            return true;
        }
        return false;
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
            fclose(current($this->dat));
            return true;
        }
        return false;
    }

    /**
     * public function touch
     * @parameters string
     *
     */
    // Create new File Or check if exists
    public function touch(string $filename): bool {
        \file_put_contents($filename, "");
        if (file_exists($filename)) {
            return true;
        }
        return false;
    }

    /**
     * public function touch
     * @parameters string
     *
     */
    // Create new File Or check if exists
    public function touch_dir(string $directory): bool {
        $directory = \str_replace("\\", "/", $directory);
        $directory = explode("/", $directory); 
        $i = 0;
        $dir_structs = ".";
        //$directory = json_decode($directory);
        foreach ($directory as $d) {
            if (!is_dir($dir_structs . "/" . $d))
                \mkdir($dir_structs . "/" . $d);
            if (!is_dir($dir_structs . "/" . $d))
                return false;
            $dir_structs .= "/" . $d;
        }
        
        return false;
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
        if ($bool == true)
            $rw .= '+';

        if (!is_dir($this->dir))
            $this->touch_dir($this->dir);
        if (!file_exists($this->dir . $r))
            $this->touch($this->dir . $r);
        $ed = fopen($this->dir . "/" . $r, $rw);
        $this->add($this->dir . $r, $ed);
        $this->sync();
        return true;
    }

    /**
     * public function size
     * @parameters string
     *
     */
    // Report how many streams in Object
    public function size(): int {
        return count($this->dat);
    }

    /**
     * public function remove
     * @parameters string
     *
     */
    // Remove Stream at index $r
    public function removeIndex(int $r): bool {
        if (!is_array($this->dat)) {
            $this->dat = [];
            return false;
        }
        $j = array_splice($this->dat, $r, 1);
        return true;
    }

    /**
     * public function fileSize
     * @parameters none
     *
     */
    // Get FileSize
    public function fileSize(): int {
        return filesize(key($this->dat));
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
            return false;
        return true;
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
            return false;
        if (current($this->dat) == null || key($this->dat) == null) {
            throw new IndexException('Stream is null');
            return false;
        }
        else
            fseek(current($this->dat), $pos, $f);
        return true;
    }

    /**
     * public function eof
     * @parameters none
     *
     */
    // Check for End of File
    public function eof(): bool {
        if (feof(current($this->dat)) || key($this->dat) == null)
            return false;
        else
            return true;
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
            return false;
        }
        if ($this->size() == 0) {
            throw new IndexException('Empty Stream Array');
            return false;
        }
        if (!file_exists(key($this->dat)))
            return false;
        if ($this->buffSize == 0) {
            $path = $this->pt[1];
            $this->buffData = file_get_contents($path);
            return true;
        }
        else
            $y = $this->buffSize;

        for ($i = 0; $i < $y; $i++) {
            $buf = fgetc($this->strm);
            if ($buf == '<')
                $buf = '&lt;';
            if ($buf == $this->delim || feof($this->pt[0]))
                break;
            $this->buffData .= $buf;
        }
        return true;
    }

    /**
     * public function writeBuf
     * @parameters none
     *
     */
    // Write to Buffer File
    public function writeBuf(): int {
        echo json_encode($this->dat);
        return fwrite(current($this->dat), $this->buffData, $this->buffSize);
    }

    /**
     * public function close
     * @parameters none
     *
     */
    // Close File
    public function close(): bool {
        fclose(current($this->dat));
        $this->remSeqStrm($this->getIndex());
        $this->setIndex($this->getIndex());
        return true;
    }

    /**
     * public function changeDir
     * @parameters string
     *
     */
    // Change local directory
    public function changeDir(string $directory): string {
        $this->dir = null;
        
        $this->dir = $directory;
        $this->touch_dir($directory);
        return true;
    }
}

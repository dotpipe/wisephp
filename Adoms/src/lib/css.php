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

class css
{
    public $filename;
    public $ext_int;
    public $id;
    public $classname;
    public $selector;
    public $property;
    public $value;
    public $inline;
    public $fwriter;
    public $freader;
    public $html;
    public $desc;
    public $text;
    public $mCSS = array();
    public $imps;
    public $indent;

    public function __construct($fname = "")
    {
        $this->filename = $fname;
        $this->ext_int = 0;
        if ($this->filename == "") {
            $this->ext_int = 1;
        }
        $this->mCSS = new mMap();
        $this->imps = new Set();
        $this->fwriter = new writeStream();
        $this->freader = new readStream();
        if ($this->filename != "") {
            $this->fwriter->addStrm($this->filename,$this->ext_int);
        }
        $this->indent = "<img src=\".\\src\\icons\\design.gif\">";
    }

    /**
     * public function size
     * @parameters
     *
     */
    // Report how many CSS Elements in Container
    public function size(): int
    {
        if (count($this->mCSS->kv) > 0) {
            return count($this->mCSS->kv);
        }
        return 0;
    }

    /**
     * public function setIndent
     * @parameters string
     *
     */
    public function setIndent(string $ind): bool
    {
        $this->indent = $ind;
        return 1;
    }

    /**
     * public function clear
     * @parameters none
     *
     */
    public function clear(): bool
    {
        $this->mCSS = new mMap();
        $this->imps = new Set();
        $this->fwriter = new writeStream();
        $this->freader = new readStream();
        return 1;
    }

    /**
     * public function add
     * @parameters string, mixed
     *
     */
    public function add(string $selector, $map): bool
    {
        $this->mCSS->newMap($selector, $map);
        return 1;
    }

    /**
     * public function write
     * @parameters none
     *
     */
    public function write(): bool
    {
        if ($this->size() == 0)
            return 0;
        if ($this->fwriter->size() == 0)
            return 0;
        $this->fwriter->buf = "";
        $this->fwriter->sync();
        if ($this->ext_int == 0 || $this->filename != "") {
            $this->fwriter->touch($this->filename);
        }
        if ($this->ext_int == 1 || file_exists($this->filename)) {
            $this->fwriter->Iter();
            if ($this->ext_int == 1) {
                $this->fwriter->buf = "<style>";
            }
            $this->mCSS->setIndex(0);
            $i = 0;
            while ($this->imps->size() > $i) {
                $this->fwriter->buf .= "@import url(\"" . $this->imps->dat[$i] . "\");";
                $i++;
            }
            $k = 0;
            $keys = array_keys($this->mCSS->kv);
            do {
                //echo json_encode($this->mCSS->kv[(string)$keys[$k]]->kv);
                $tm = ($this->mCSS->kv[(string)$keys[$k]]->kv);
                $i = 0;
                $this->fwriter->buf .= $keys[$k] . " {";
                while ($i < count($tm)) {
                    $j = 0;
                    $i++;
                    while (count($tm) > $j) {
                        if (key($tm) != "")
                            $this->fwriter->buf .= key($tm) . ":" . current($tm) . ";";
                        next($tm);
                        $j++;
                    }
                    next($tm);
                    if ($tm == null)
                        break;
                }
                $this->fwriter->buf .= "}";
                $k++;
            } while ($k < count($keys));
            if ($this->ext_int == 1) {
                $this->fwriter->buf .= "</style>";
                $outstring = $this->fwriter->buf;
                echo $outstring . "<br>";
                $this->fwriter->buf = "";
            }
            else {
                $this->fwriter->writeBuf();
                echo "<style>@import url(\"" . $this->filename . "\");</style>";
            }
        }
        else
            echo "Could not create file $this->filename";
        return 1;
    }

    /**
     * public function cssMap
     * @parameters string, bool
     *
     */
    public function cssMap(string $s, bool $bool): mMap
    {

        preg_match_all("/[\{\}]|[0-9\.]+[;$]|[\"'#@\(\)>\-A-z0-9\s\.]+[\{:;$]{1}/", $s, $tok);

        $lvl = 0;
        $tmp = $tok[0];
        $output = "";
        $smallMap = new Map();
        $apiMap = new mMap();
        $mapname = "";
        for ($i = 0 ; $i < sizeof($tmp) ; $i++) {
            $temp = $tmp[$i];

            if (preg_match("/[\}]/", $temp))
                $lvl = 0;
            for ($j = 0 ; $j < $lvl ; $j++) {
                $output = $output . "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;";
                $output = $output . $this->indent;
            }
            if (preg_match("/[\{]/", $temp))
                $lvl = 1;
            $imps = 0;
            if ($i + 1 < sizeof($tmp) && preg_match("/[#@\,_\(\)>\-A-z0-9\s\.]+[\{:$]{0}/", $temp, $t)) {
                if (preg_match("/[\{]/", $temp, $tk)) {
                    $output = $output . $t[0] . ' {<br>';
                    $mapname = $t[0];
                }
                else if (preg_match("/[@]/", $temp)) {
                    preg_match_all("/[\@impor]+[t\s$]{1,2}|[url\(][\"'$]{1}+|[_\/\-A-z0-9\s\.]+|['\"\)$]{2}+|[;$]/", $temp, $tk);
                    $this->imps->add($tk[0][3]);
                    $output = $output . '@import url("' . $tk[0][3] . '");<br>';
                }
                else {
                    $i++;
                    preg_match("/[\/\\\(\)\-A-z0-9\s\.]+[;$]{0}/", $tmp[$i], $tm);
                    $smallMap->add($t[0],$tm[0]);
                    $output = $output . $t[0] . ': ' . $tm[0] . ';<br>';
                }
            }
            else if (preg_match_all("/[\}]{1}/", $temp)) {
                $apiMap->newMap($mapname,$smallMap);
                $smallMap->clear();
                $mapname = "";
                $output = $output . $temp . '<br>';
            }
        }
        $this->mCSS = $apiMap;
        if ($bool == 1) {
            echo $output;
        }
        return $apiMap;
    }

    /**
     * public function convert
     * @parameters mMap
     *
     */
    public function convert(mMap $va): ?string
    {
        $outstring = "";
        $lvl = 0;
        if ("mMap" != $va->typeOf) {
            return null;
        }
        $i = 0;
        $va->setIndex(0);
        if ($this->ext_int) {
            $outstring = sprintf($outstring . "<style>");
        }
        while ($this->imps->size() > $i) {
            $outstring = sprintf($outstring . "@import url('" . $this->imps->dat[$i] . "');");
            $i++;
        }
        do {
            $temp = $va->mmap;
            if (preg_match("/[\{]/", $va->mname)) {
                $outstring = sprintf($outstring . $va->mname);
            } else {
                $outstring = sprintf($outstring . $va->mname . " {");
            }
            $i = 0;
            while ($temp->size() > $i) {
                if (preg_match("/[:]/", $temp->key[$i])) {
                    $outstring = sprintf($outstring . $temp->key[$i]);
                } else {
                    $outstring = sprintf($outstring . $temp->key[$i] . ":");
                }
                if (preg_match("/[;]/", $temp->value[$i])) {
                    $outstring = sprintf($outstring . $temp->value[$i]);
                } else {
                    $outstring = sprintf($outstring . $temp->value[$i] .';');
                }
                $i++;
            }
            $outstring = sprintf($outstring . '}');
        } while ($temp->Iter());
        if ($this->ext_int) {
            $outstring = $outstring . '</style>';
        }
        return $outstring;
    }
}
